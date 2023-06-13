<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index()
    {
        $datas = Post::with(['user', 'category'])
            ->where('accepted_by', null)
            ->orderBy('created_at', 'desc')->get();

        return view('module3.discussion-board', compact('datas'));
    }

    public function answerQuestion(Request $request)
    {
        $request->merge([
            'accepted_by' => auth()->user()->id
        ]);
        $post = Post::find($request->post_id);
        $post->update($request->all());

        return redirect()->back()
            ->with('success', "Post Successfully Answered!");
    }

    public function profile()
    {
        $expert = Expert::with('user')->where('user_id', auth()->user()->id)->first();

        return view('module3.expert-profile-edit', compact('expert'));
    }
}
