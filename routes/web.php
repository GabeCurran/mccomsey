<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MultipleUploadController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

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
    })->middleware('verified');

    Route::get('/', function () {
        $content = DB::select("
            SELECT content FROM home
            WHERE id = 1
        ");
        return view('home')
            ->with(['content' => $content[0]->content])
            ->with('posts', BlogPost::all());
    })->name('home')->middleware('verified');

    Route::get('/home-editor', function () {
        $content = DB::select("
        select content from home where id = 1
      ");
        return view('home-editor')->with(['content' => $content[0]->content]);
    })->name('home-editor')->middleware('verified');;

    Route::get('/blog', function () {
        return view('blog')->with('posts', BlogPost::all());
    })->name('blog')->middleware('verified');;

    Route::post('/create-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::create($validated);
        return redirect('blog');
    })->name('create-post')->middleware('verified');;

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
    })->name('edit-home')->middleware('verified');;

    Route::post('/image-upload', [MultipleUploadController::class, 'store'])->name('image-upload');
    Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
 
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');
 
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

require __DIR__.'/auth.php'; 
