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

Route::group(['middleware' => ['auth']], function () {


    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('/', function () {
        $content = DB::select("
            SELECT content FROM home
            WHERE id = 1
        ");
        return view('home')
            ->with(['content' => $content[0]->content])
            ->with('posts', BlogPost::all());
    })->name('home');

    Route::get('/appointments', function () {
        return view('appointments');
    })->name('appointments');

    Route::post('/create-appointment', function () {
        $appointment = new Appointment;
        $appointment->name = request('name');
        $appointment->email = request('email');
        $appointment->phone = request('phone');
        $appointment->date = request('date');
        $appointment->time = request('time');
        $appointment->message = request('message');
        $appointment->save();
        return redirect('/appointments');
    })->name('create-appointment');

    Route::get('/home-editor', function () {
        $content = DB::select("
        select content from home where id = 1
      ");
        return view('home-editor')->with(['content' => $content[0]->content]);
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
