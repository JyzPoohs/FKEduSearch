<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserController extends Controller
{
    //to display user dashboard
    public function index()
    {
        $datas = User::with('role')->whereDoesntHave('role', function ($query) {
            $query->where('code', 3);
        })->paginate(10);
        $totalUser = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 1)->first()->id)->count();
        $totalExpert = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 2)->first()->id)->count();
        $totalAdmin = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 3)->first()->id)->count();
        $totalActiveUser = User::where('is_approved', 1)->count();

        return view('module1.manage', compact('datas', 'totalUser', 'totalExpert', 'totalAdmin', 'totalActiveUser'));
    }

    //to display edit user interface
    public function edit($id)
    {
        $data = User::find($id);
        $roles = Reference::where('name', 'roles')->orderBy('code')->get();

        return view('module1.edit', compact('data', 'roles'));
    }

    //to delete user
    public function destroy($user)
    {
        User::find($user)->delete();

        return response()->json(['success' => true]);
    }

    //to display create user interface
    public function create()
    {
        $roles = Reference::where('name', 'roles')->orderBy('code')->get();

        return view('module1.create', compact('roles'));
    }

    //to save new user into database
    public function store(Request $request)
    {
        $request->merge([
            'password' => 'password'
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Added");
    }

    //to save updated user info in database
    public function update(Request $request, $user)
    {
        User::find($user)->update($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Updated");
    }


    public function profile()
    {
        $datas = Post::with(['user', 'expert', 'category', 'likes'])->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $user = User::find(auth()->user()->id);

        return view('module2.user-profile-edit', compact('user', 'datas'));
    }

    public function profileView($id)
    {
        $user = User::with(['role', 'posts', 'likes'])->find($id);

        return view('module2.user-profile-view', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $destinationPath = 'uploads';
        if ($request->hasFile('avatar_upload')) {
            $avatarFile = $request->file('avatar_upload');
            $avatarPath = $avatarFile->getClientOriginalName();
            $avatarFile->move($destinationPath, $avatarPath);
            $request->merge([
                'avatar' => $avatarPath ?? "",
            ]);
        }

        if ($request->has('expert')) {
            $expert = collect($request->expert);
            if ($request->hasFile('cv')) {
                $cvFile = $request->file('cv');
                $cvPath = $cvFile->getClientOriginalName();
                $cvFile->move($destinationPath, $cvPath);
                $expert = $expert->merge([
                    'cv_upload' => $cvPath ?? "",
                ]);
            }
            $user->expert->update($expert->toArray());
        }

        $user->update($request->all());

        return redirect()->back()->with('success', "Profile Successfully Updated!");
    }

    //to show user information
    public function show($id)
    {
        $data = User::find($id);

        return view('module1.show', compact('data'));
    }

    // public function report()
    // {
    //     #Retrieve the necessary data
    //     $datas = User::whereNotNull('last_login')
    //         ->orderBy('last_login', 'desc')
    //         ->paginate(10);
    //     $users = User::whereNotNull('last_login')->get();


    //     $datas;

    //     #Set the time range for active users (e.g., last 30 days)
    //     $timeRange = Carbon::now()->subDays(30);

    //     # Calculate KPI metrics
    //     $totalExperts = $users->where('ref_role_id', 9)->count();
    //     $totalUsers = $users->count();
    //     $activeUsers = $users->where('last_login', '>=', $timeRange)->count();
    //     $percentageActive = number_format((($activeUsers / $totalUsers) * 100), 2);

    //     # Generate the KPI report
    //     $report = [
    //         'Total Experts' => $totalExperts,
    //         'Total Users' => $totalUsers,
    //         'Active Users' => $activeUsers,
    //         'Percentage Active' => $percentageActive,
    //     ];

    //     # Pass the report data to a view for rendering
    //     return view('module1.report', compact('datas', 'report'));
    // }
}
