<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Home;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\MultipleUploadController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EditHomeController;
use App\Http\Controllers\BlogController;
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
Route::get('/', PagesController::class)->name('home');

Route::group(['middleware' => ['verified']], function () {


    Route::get('/home', function () {
        return redirect('/');
    })->name('home');

    Route::get('/appointments', [AppointmentController::class, 'show'])->name('appointments');
    Route::post('/create-appointment', [AppointmentController::class, 'create'])->name('create-appointment');
    Route::post('/complete-appointment', [AppointmentController::class, 'complete'])->name('complete-appappointment');
    Route::post('/confirm-appointment' , [AppointmentController::class, 'confirm'])->name('confirm-appointment');
    Route::post('/remove-appointment' , [AppointmentController::class, 'remove'])->name('remove-appointment');
    
    Route::get('/home-editor', [EditHomeController::class, 'show'])->name('home-editor');
    Route::post('/edit-home', [EditHomeController::class, 'update'])->name('edit-home');

    Route::get('/blog', [BlogController::class, 'show'])->name('blog');
    Route::post('/create-post', [BlogController::class, 'create'])->name('create-post');
    Route::post('/edit-post', [BlogController::class, 'edit'])->name('edit-post');

    Route::post('/update-post', function (Request $request) {
        if (auth()->user()->admin) {
            $validated = $request->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:10'
            ]);
            BlogPost::where('id', $request->post_id)->update($validated);
            return redirect($request->route . '#post' . $request->post_id);
        } else {
            return redirect('/');
        }
    })->name('update-post');

    Route::post('/delete-post', function (Request $request) {
        if (auth()->user()->admin) {
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
        } else {
            return redirect('/');
        }
    })->name('delete-post');

    Route::post('/create-comment', function (Request $request) {
        $validated = $request->validate([
            'post_id' => 'required|exists:blog_posts,id',
            'comment' => 'required|min:1'
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

    Route::post('/image-upload', [MultipleUploadController::class, 'store'])->name('image-upload');
    
    // Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);

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
