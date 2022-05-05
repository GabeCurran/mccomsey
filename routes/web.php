<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Home;
use App\Models\Appointment;
use App\Models\Service;
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
        $appointments = DB::select("
            SELECT phone, appointment_date, service, description, confirmed, completed, service_name 
            FROM appointments
            JOIN services ON appointments.service = services.id
            WHERE user_id = " . auth()->user()->id . "
            ORDER BY appointment_date
            ");
        return view('appointments')->with('appointments', $appointments)
            ->with('services', Service::all());
    })->name('appointments');

    Route::post('/create-appointment', function () {
        $appointment = new Appointment;
        $appointment->user_id = auth()->user()->id;
        $appointment->phone = request('phone');
        $appointment->appointment_date = request('date');
        $appointment->service = request('service');
        $appointment->description = request('details');
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
