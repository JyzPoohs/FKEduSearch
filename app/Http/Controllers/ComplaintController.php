<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        $datas = Complaint::with('type')->paginate(10);

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
}
