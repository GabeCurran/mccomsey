<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\MultipleUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {


    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('/', function () {
        $content = DB::select("
            SELECT content FROM home
            WHERE id = 1
        ");
        
        $posts = DB::select('
        select p.created_at, p.id, p.title, p.content, p.user_id, u.name, count(l.id) as likes, count(c.id) as commentsCount
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
    })->name('home');

    Route::get('/home-editor', function () {
        $content = DB::select("
        select content from home where id = 1
      ");
        return view('home-editor')->with(['content' => $content[0]->content]);
    })->name('home-editor');

    Route::get('/blog', function () {
        $posts = DB::select('
            select p.created_at, p.id, p.title, p.content, p.user_id, u.name, count(l.id) as likes, count(c.id) as commentsCount
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
    })->name('blog');

    Route::post('/create-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::create($validated + ['user_id' => auth()->id()]);
        return redirect('blog#post' . BlogPost::all()->last()->id);
    })->name('create-post');

    Route::post('/edit-post', function (Request $request) {
        $post = BlogPost::find($request->post_id);
        return view('edit-post')->with('post', $post)
        ->with('route', $request->route);
    })->name('edit-post');

    Route::post('/update-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::where('id', $request->post_id)->update($validated);
        return redirect($request->route . '#post' . $request->post_id);
    })->name('update-post');

    Route::post('/delete-post', function (Request $request) {
        $post = BlogPost::findOrFail($request->post_id);
        if ($post->user_id == auth()->user()->id) {
            $comments = Comment::where('post_id', $request->post_id);
            $comments->delete();
            $likes = Like::where('post_id', $request->post_id);
            $likes->delete();
            $post->delete();
            return redirect($request->route)->with('success', 'Post deleted successfully');
        } else {
            return redirect($request->route)->with('error', 'You can only delete your own posts');
        }
    })->name('delete-post');

    Route::post('/create-comment', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id',
            'comment' => 'required|min:10'
        ]);
        Comment::create($validated + ['user_id' => auth()->user()->id]);
        return redirect($request->route . '#comment' . Comment::all()->last()->id);
    })->name('create-comment');

    Route::post('/like-post', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id'
        ]);
        $user = auth()->user();
        Like::create($validated + ['user_id' => $user->id]);
        return redirect($request->route . '#like' . $validated['post_id']);
    })->name('like-post');

    Route::post('/unlike-post', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id'
        ]);
        $user = auth()->user();
        Like::where('user_id', $user->id)
            ->where('post_id', $validated['post_id'])
            ->delete();
        return redirect($request->route . '#like' . $validated['post_id']);
    })->name('unlike-post');

    // Route::post('multiple-image-upload', [MultipleUploadController::class, 'upload']);

    Route::post('/edit-home', function (Request $request) {
        $content = $request->input('content');
        $content = str_replace("'", "\'", $content);
        $content = str_replace('"', '\"', $content);
        DB::update("
        update home
        set content = '{$content}'
        where id = 1
      ");
      return redirect('home');
    })->name('edit-home');

    Route::post('/image-upload', [MultipleUploadController::class, 'store'])->name('image-upload');
});

require __DIR__.'/auth.php'; 
