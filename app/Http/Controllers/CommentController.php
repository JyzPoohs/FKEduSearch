<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        Comment::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Comment Successfully Added!");
    }
}
