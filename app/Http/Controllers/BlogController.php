<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BlogPost;

class BlogController extends Controller
{
    //
    public function show() {
        $posts = DB::select('
            select p.created_at, p.id, p.title, p.content, p.user_id, u.name, count(distinct l.id) as likes, count(distinct c.id) as commentsCount
            from blog_posts p
            join users u on p.user_id = u.id
            left join likes l on p.id = l.post_id
            left join comments c on p.id = c.post_id
            group by p.id, p.title, p.content, u.name, p.created_at, p.user_id
            order by p.created_at desc
        ');

        $comments = DB::select('
            select c.id, c.post_id, c.comment, c.created_at, u.name
            from comments c
            join users u on c.user_id = u.id
        ');

        $user = auth()->user();
        $userLikes = DB::select('
            select post_id from likes
            where user_id = ' . $user->id . '
        ');

        $likeArr = [];
        foreach ($userLikes as $like) {
            array_push($likeArr, $like->post_id);
        }

        return view('blog')->with('posts', $posts)
            ->with('comments', $comments)
            ->with('likes', $likeArr);
    }

    public function create(Request $request) {
        if (auth()->user()->admin) {
            $validated = $request->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:10'
            ]);
            BlogPost::create($validated + ['user_id' => auth()->id()]);
            return redirect('blog#post' . BlogPost::all()->last()->id);
        } else {
            return redirect('/');
        }
    }

    public function edit(Request $request) {
        if (auth()->user()->admin) {
            $post = BlogPost::find($request->post_id);
            return view('edit-post')->with('post', $post)
            ->with('route', $request->route);
        } else {
            return redirect('/');
        }
    }
}
