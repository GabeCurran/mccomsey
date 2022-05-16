<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    public function __invoke()
    {
        if (Auth::check() == true && Auth::user()->email_verified_at != null) {
            $content = DB::select("
            SELECT content FROM home
            WHERE id = 1
        ");
        
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

        return view('home')
            ->with(['content' => $content[0]->content])
            ->with('posts', $posts)
            ->with('comments', $comments)
            ->with('likes', $likeArr);
        } else {
            $content = DB::select("
                SELECT content FROM home
                WHERE id = 1
            ");
                
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
            return view('guesthome')->with('posts', $posts)
                ->with('content', $content[0]->content)
                ->with('comments', $comments);
        }
    }
}
