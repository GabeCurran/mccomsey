<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MultipleUploadController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EditHomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    Route::post('/update-post', [BlogController::class, 'update'])->name('update-post');
    Route::post('/delete-post', [BlogController::class, 'delete'])->name('delete-post');

    Route::post('/create-comment', [FeedbackController::class, 'comment'])->name('create-comment');
    Route::post('/like-post', [FeedbackController::class, 'like'])->name('like-post');
    Route::post('/unlike-post', [FeedbackController::class, 'unlike'])->name('unlike-post');

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
