<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->code == 2) {
            $datas = Feedback::with(['user', 'post' => function ($query) {
                $query->where('accepted_by', auth()->user()->id);
            }])->paginate(10);
        } else {
            $datas = Feedback::with('user', 'post')->paginate(10);
        }

        return view('module3.feedback-list', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        Feedback::create($request->all());

        return redirect()->back()
            ->with('success', "Feedback Successfully Submitted!");
    }
}
