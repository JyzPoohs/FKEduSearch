<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        Like::create($request->all());

        return redirect()->route('post.index');
    }
}
