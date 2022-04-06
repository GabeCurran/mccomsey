<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
 
use App\Models\Image;
 
use Validator;

use Illuminate\Http\Request;


class MultipleUploadController extends Controller
{
 
public function store(Request $request)
{
    // if(!$request->hasFile('upload')) {
    //     return json_encode(['uploaded' => false, 'error' => 'could not upload this image']);
    // }
 
    // $allowedfileExtension=['pdf','jpg','png', 'jpeg'];
    // $file = $request->upload; 
    // $errors = [];   
 
    // $extension = $file->getClientOriginalExtension();

    // $check = in_array($extension,$allowedfileExtension);

    // if($check) {

    // $name = $file->getClientOriginalName();
    // $file-> move(public_path('images'), $name);
    // $path = 'images/'.$name;

    //     //store image file into directory and db
    //     $save = new Image();
    //     $save->title = $name;
    //     $save->path = $path;
    //     $save->save();
    // } else {
    //     return json_encode(['uploaded' => false, 'error' => 'could not upload this image']);
    // }

    // return json_encode(['uploaded' => true, 'url' => $path]);

    $image = $request->file('upload');
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'https://api.imgur.com/3/upload', [
        'headers' => [
            'Authorization' => 'Client-ID ' . env('384bfe0c42c8438'),
            'name' => $image->getClientOriginalName()
        ],
        'multipart' => [
            [
                'name' => 'image',
                'contents' => fopen($image, 'r'),
            ],
        ],
    ]);
    $response = json_decode($response->getBody()->getContents());
    return json_encode(['uploaded' => true, 'url' => $response->data->link]);
    // return json_encode(['uploaded' => true, 'url' => 'images/mccomsey.png']);
}
}
