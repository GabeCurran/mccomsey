<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Like;

class FeedbackController extends Controller
{
    //
    public function comment(Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id',
            'comment' => 'required|min:1'
        ]);
        Comment::create($validated + ['user_id' => auth()->user()->id]);
        return redirect($request->route . '#comment' . Comment::all()->last()->id);
    }

    public function like(Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id'
        ]);
        $user = auth()->user();
        Like::create($validated + ['user_id' => $user->id]);
        return redirect($request->route . '#like' . $validated['post_id']);
    }

    public function unlike(Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id'
        ]);
        $user = auth()->user();
        Like::where('user_id', $user->id)
            ->where('post_id', $validated['post_id'])
            ->delete();
        return redirect($request->route . '#like' . $validated['post_id']);
    }
}
