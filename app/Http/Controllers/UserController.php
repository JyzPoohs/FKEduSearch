<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $datas = User::with('role')->paginate(10);
        $totalUser = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 1)->first()->id)->count();
        $totalExpert = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 2)->first()->id)->count();
        $totalAdmin = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 3)->first()->id)->count();
        $totalActiveUser = User::where('ref_role_id', Reference::where('name', 'roles')->where('code', 3)->first()->id)
            ->where('is_approved', 1)
            ->count();

        return view('module1.manage', compact('datas', 'totalUser', 'totalExpert', 'totalAdmin', 'totalActiveUser'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        $roles = Reference::where('name', 'roles')->orderBy('code')->get();

        return view('module1.edit', compact('data', 'roles'));
    }

    public function destroy($user)
    {
        User::find($user)->delete();

        return response()->json(['success' => true]);
    }

    public function create()
    {
        $roles = Reference::where('name', 'roles')->orderBy('code')->get();

        return view('module1.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'password' => 'password'
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Added");
    }

    public function update(Request $request, $user)
    {
        User::find($user)->update($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Updated");
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);

        return view('module2.user-profile-edit', compact('user'));
    }

    public function profileView($id)
    {
        $user = User::with(['role', 'posts', 'likes'])->find($id);

        return view('module2.user-profile-view', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $user->update($request->all());

        return redirect()->back()->with('success', "Profile Successfully Updated!");
    }

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
