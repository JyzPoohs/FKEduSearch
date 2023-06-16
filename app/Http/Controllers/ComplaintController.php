<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Complaint;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    //To display complaint list
    public function index()
    {
        if (auth()->user()->role->code == 1) {
            $datas = Complaint::with(['user', 'post', 'type', 'status'])
                ->where('user_id', auth()->user()->id)->get();
            return view('module5.user.manage', compact('datas'));
        } else {
            $datas = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->get();
            return view('module5.admin.manage', compact('datas'));
        }
    }

    public function create(Request $request)
    {
        $post = Post::find($request->post_id);
        return view('complaint.create', compact('post'));
    }

    //To display file complaint form
    public function file($id)
    {
        $data = Post::with(['user', 'expert', 'category', 'likes'])->where('id', $id)->first();

        return view('complaint.create', compact('data'));
    }

    //Store user file complaint record
    public function store(Request $request)
    {
        $request->validate(
            [
                'ref_complaint_type_id' => 'required'
            ],
            [
                'ref_complaint_type_id.required' => 'Must select a complaint type'
            ]
        );

        $request->merge([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id,
            'ref_complaint_status_id' => '15',
        ]);

        Complaint::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Complaint Successfully Added");
    }

    //To search complaint list by complaint type
    public function search(Request $request)
    {
        $complaintType = $request->input('ref_complaint_type_id');
        $datas = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->where('ref_complaint_type_id', $complaintType)->get();

        return view('module5.admin.manage', compact('datas'));
    }

    //To display edit complaint form
    public function show($id)
    {
        $data = Complaint::with(['user', 'post', 'type', 'status'])->find($id);

        return view('complaint.edit', compact('data'));
    }

    //To update edited complaint info
    public function update(Request $request, $complaint)
    {
        Complaint::find($complaint)->update($request->all());

        return redirect()->route('complaint.index')
            ->with('success', "Complaint Successfully Updated");
    }

    //To delete selected complaint record
    public function destroy($property)
    {
        Complaint::find($property)->delete();

        return response()->json(['success' => true]);
    }

    //To get the complaint report
    public function report()
    {
        # Retrieve the necessary data
        $complaints = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->get();
        $totalComplaints = Complaint::count();

        # Set the time range for complaints in 30 days
        $timeRange = Carbon::now()->subDays(30);

        # Calculate complaint type KPI metrics
        $unsatisfiedComplaints = $complaints->where('ref_complaint_type_id', 11)->count();
        $wrongAssignedComplaints = $complaints->where('ref_complaint_type_id', 12)->count();
        $inappropriateComplaints = $complaints->where('ref_complaint_type_id', 13)->count();

        #Calculate complaint status KPI metrics
        $investigateComplaints = $complaints->where('ref_complaint_status_id', '14')->count();
        $holdComplaints = $complaints->where('ref_complaint_status_id', '15')->count();
        $resolvedComplaints = $complaints->where('ref_complaint_status_id', '16')->count();

        #Calculate total complaints that havent solved
        $unresolvedComplaints = $totalComplaints - $resolvedComplaints;

        # Generate the KPI report
        $report = [
            'Total Complaint' => $totalComplaints,
            'Unsatisfied Complaints' => $unsatisfiedComplaints,
            'Wrongly Assigned Complaints' => $wrongAssignedComplaints,
            'Inappropriate Complaints' => $inappropriateComplaints,
            'In Investigation Complaints' => $investigateComplaints,
            'On Hold Complaints' => $holdComplaints,
            'Resolved Complaints' => $resolvedComplaints,
            'Unresolved Complaints' => $unresolvedComplaints,
        ];


        # Pass the report data to a view for rendering
        return view('module5.admin.report', compact('complaints', 'report'));
    }
}
