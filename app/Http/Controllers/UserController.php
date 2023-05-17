<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::with('role')->paginate(10);

        return view('user.manage', compact('datas'));
    }

    public function edit($id)
    {
        $data = User::find($id)->toArray();

        return view('user.edit', compact('data'));
    }

    public function destroy($property)
    {
        User::find($property)->delete();

        return response()->json(['success' => true]);
    }

    public function create()
    {
        $roles = Reference::where('name', 'roles')->orderBy('code')->get();

        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'password' => bcrypt('password')
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Added");
    }

    public function update(Request $request, $property)
    {
        User::find($property)->update($request->all());

        return redirect()->route('user.index')
            ->with('success', "User Successfully Updated");
    }
}
