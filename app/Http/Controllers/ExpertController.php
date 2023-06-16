<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Post;
use App\Models\Reference;
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
            'accepted_by' => auth()->user()->id,
            'ref_post_status_id' => Reference::where('name', 'post-status')->where('code', 2)->first()->id
        ]);
        $post = Post::find($request->post_id);
        $post->update($request->all());

        return redirect()->back()
            ->with('success', "Post Successfully Answered!");
    }

    public function profile()
    {
        $expert = Expert::with('user')->where('user_id', auth()->user()->id)->first();
        $categories = Reference::where('name', 'category')->orderBy('code')->get();

        return view('module3.expert-profile-edit', compact('expert', 'categories'));
    }

    public function profileView($id)
    {
        $user = User::with(['role', 'posts', 'likes'])->find($id);


        return view('module3.expert-profile-view', compact('user'));
    }
}
