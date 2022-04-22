<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
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
    Route::get('/', function () {
        return view('home');
    })->name('home');


    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('/blog', function () {
        $posts = DB::select('
            select p.id, p.title, p.content, count(l.id) as likes
            from blog_posts p
            left join likes l on p.id = l.post_id
            group by p.id, p.title, p.content
            order by p.created_at desc
        ');
        return view('blog')->with('posts', $posts)
            ->with('comments', Comment::all());
    })->name('blog');

    Route::post('/create-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::create($validated);
        return redirect('blog');
    })->name('create-post');

    Route::post('/create-comment', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id',
            'username' => 'required|min:3',
            'comment' => 'required|min:10'
        ]);
        Comment::create($validated);
        return redirect('blog');
    })->name('create-comment');

    Route::post('/like-post', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id'
        ]);
        $user = auth()->user();
        Like::create($validated + ['user_id' => $user->id]);
        return redirect('blog');
    })->name('like-post');

    // Route::post('multiple-image-upload', [MultipleUploadController::class, 'upload']);

    Route::post('/image-upload', [MultipleUploadController::class, 'store'])->name('image-upload');
});

require __DIR__.'/auth.php'; 
