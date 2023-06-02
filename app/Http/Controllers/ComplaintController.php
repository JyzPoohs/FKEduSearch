<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Complaint;
use Carbon\Carbon;

class ComplaintController extends Controller
{
    public function index()
    {
        $datas = Complaint::with(['user', 'post', 'type', 'status'])->orderBy('created_at', 'desc')->get();
        //dd($datas);

        return view('module5.admin.manage', compact('datas'));
    }

    public function create()
    {
        $roles = Reference::where('name', 'complaint_type')->orderBy('code')->get();

        return view('complaint.create', compact('roles'));
    }

    public function edit($id)
    {
        $data = Complaint::find($id)->toArray();

        return view('complaint.edit', compact('data'));
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
