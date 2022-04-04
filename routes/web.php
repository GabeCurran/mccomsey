<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use Illuminate\Http\Request;

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
        return view('home')->with('posts', BlogPost::all());
    })->name('home');

    Route::post('/create-post', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        BlogPost::create($validated);
        return redirect('home');
    })->name('create-post');

    Route::post('/imgur', function (Request $request) {
        $validated = $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('upload');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.imgur.com/3/image', [
            'headers' => [
                'Authorization' => 'Client-ID ' . env('384bfe0c42c8438'),
            ],
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($image, 'r'),
                ],
            ],
        ]);
        $response = json_decode($response->getBody()->getContents());
        return response()->json([
            'link' => $response->data->link,
        ]);
    });
});

require __DIR__.'/auth.php'; 
