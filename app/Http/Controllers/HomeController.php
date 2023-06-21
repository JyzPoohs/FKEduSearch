<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Post;
use App\Models\Reference;
use App\Models\Report;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Reference::where('name', 'category')->orderBy('code')->get();
        $users = User::count();
        $complaints = Complaint::count();
        $reports = Report::count();
        $posts = Post::count();

        $values = [];
        $values['database'] = Post::where('ref_category_id', 1)->count();
        $values['networking'] = Post::where('ref_category_id', 2)->count();
        $values['web'] = Post::where('ref_category_id', 3)->count();

        return view('pages.dashboard', compact('categories', 'users', 'complaints', 'reports', 'posts', 'values'));
    }

    public function formExample()
    {
        return view('pages.form-example');
    }
}
