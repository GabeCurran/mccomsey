<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('home')->with(['content', Home::where('id = 1')]);
    })->name('home');

    Route::get('/home-editor', function () {
        return view('home-editor');
    })->name('home-editor');

    Route::get('/blog', function () {
        return view('blog')->with('posts', BlogPost::all());
    })->name('blog');

    Route::post('/create-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::create($validated);
        return redirect('blog');
    })->name('create-post');

    Route::post('/edit-home', function (Request $request) {
        DB::update("
        update home
        set content = '{$request->input('content')}'
        where id = 1
      ");
      return redirect('home');
    })->name('edit-home');

    // Route::post('multiple-image-upload', [MultipleUploadController::class, 'upload']);

    Route::post('/image-upload', [MultipleUploadController::class, 'store'])->name('image-upload');
});

require __DIR__.'/auth.php'; 
