<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reference;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Reference::where('name', 'category')->orderBy('code')->get();
        $title_search = ($request->has('title')) ? $request->title : null;
        $selected_category = ($request->has('ref_category_id')) ? $request->ref_category_id : null;

        $datas = Post::with(['user', 'expert', 'category', 'likes'])
            ->when($title_search != null, function ($query) use ($title_search) {
                $query->where('title', 'like', '%' . $title_search . '%');
            })
            ->when($selected_category != null, function ($query) use ($selected_category) {
                $query->where('ref_category_id', $selected_category);
            })
            ->orderBy('created_at', 'desc')->get();

        return view('module2.discussion-board', compact('datas', 'categories', 'title_search', 'selected_category'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'ref_post_status_id' => Reference::where('name', 'post-status')->where('code', 1)->first()->id,
        ]);

        Post::create($request->all());

        return redirect()->route('post.index')
            ->with('success', "Post Successfully Posted!");
    }

    public function destroy($id)
    {
        Post::find($id)->delete();

        return response()->json(['success' => true]);
    }

    public function close($id)
    {
        Post::find($id)->update([
            'ref_post_status_id' => Reference::where('name', 'post-status')->where('code', 3)->first()->id
        ]);

        return response()->json(['success' => true]);
    }
}
