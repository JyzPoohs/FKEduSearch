<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'status' => 1,
        ]);
        Report::create($request->all());

        return redirect()->back();
    }

    public function index()
    {
        $datas = Report::with('user')->paginate(10);

        return view('module4.manage', compact('datas'));
    }

    public function edit($id)
    {
        $data = Report::find($id);

        return view('module4.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Report::find($id)->update($request->all());

        return redirect()->route('report.index')
            ->with('success', "Report Status Successfully Updated!");
    }

    public function destroy($id)
    {
        Report::find($id)->delete();

        return response()->json(['success' => true]);
    }
}
