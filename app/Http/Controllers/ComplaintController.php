<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Complaint;
use App\Models\Post;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    public function index()
    {

        if (auth()->user()->ref_role_id === 10) {
            $datas = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->get();
            return view('module5.admin.manage', compact('datas'));
        } else if (auth()->user()->ref_role_id === 8) {
            $datas = Complaint::with(['user', 'post', 'type', 'status'])
                ->where('user_id', auth()->user()->id)->get();
            return view('module5.user.manage', compact('datas'));
        }
    }

    public function create()
    {

        $datas = Complaint::with(['user', 'post', 'type', 'status'])->find(auth()->user()->id);

        //dd($datas);
        return view('complaint.create', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'ref_complaint_status_id' => '15',
        ]);

        Complaint::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Complaint Successfully Added");
    }

    public function edit($id)
    {
        // $data = User::find($id)->toArray();
        // $role = Reference::where('code', $data['ref_role_id'])
        //     ->where('name', 'roles')
        //     ->get();

        // return view('user.edit', compact('data', 'role'));
    }

    public function show($id)
    {
        $data = Complaint::with(['user', 'post', 'type', 'status'])->find($id);

        //dd($data);
        return view('complaint.edit', compact('data'));
    }

    public function update(Request $request, $complaint)
    {
        Complaint::find($complaint)->update($request->all());

        return redirect()->route('complaint.index')
            ->with('success', "Complaint Successfully Updated");
    }

    public function destroy($property)
    {
        Complaint::find($property)->delete();

        return response()->json(['success' => true]);
    }

    public function report()
    {
        # Retrieve the necessary data
        $complaints = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->get();
        $totalComplaints = Complaint::count();

        # Set the time range for active complaints (e.g., last 30 days)
        $timeRange = Carbon::now()->subDays(30);

        # Calculate KPI metrics
        $unsatisfiedComplaints = $complaints->where('ref_complaint_type_id', 11)->count();
        $wrongAssignedComplaints = $complaints->where('ref_complaint_type_id', 12)->count();
        $inappropriateComplaints = $complaints->where('ref_complaint_type_id', 13)->count();

        # Generate the KPI report
        $report = [
            'Total Complaint' => $totalComplaints,
            'Unsatisfied Complaints' => $unsatisfiedComplaints,
            'Wrongly Assigned Complaints' => $wrongAssignedComplaints,
            'Inappropriate Complaints' => $inappropriateComplaints,
        ];

        # Pass the report data to a view for rendering
        return view('module5.admin.report', compact('complaints', 'report'));
    }
}
