<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'expert_id' => auth()->user()->expert->id,
        ]);
        Publication::create($request->all());

        return redirect()->route('publication.index')
            ->with('success', "Publication Successfully Added!");
    }

    public function index()
    {
        $datas = Publication::where('expert_id', auth()->user()->expert->id)->paginate(10);

        return view('module3.publication.manage', compact('datas'));
    }

    public function edit($id)
    {
        $data = Publication::find($id);

        return view('module3.publication.edit', compact('data'));
    }

    public function create()
    {
        return view('module3.publication.create');
    }

    public function update(Request $request, $id)
    {
        Publication::find($id)->update($request->all());

        return redirect()->route('publication.index')
            ->with('success', "Publication Successfully Updated!");
    }

    public function destroy($id)
    {
        Publication::find($id)->delete();

        return response()->json(['success' => true]);
    }
}
