<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditHomeController extends Controller
{
    //
    public function show() {
        if (auth()->user()->admin) {
            $content = DB::select("
            select content from home where id = 1
        ");
            return view('home-editor')->with(['content' => $content[0]->content]);
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request) {
        if (auth()->user()->admin) {
            $content = $request->input('content');
            $content = str_replace("'", "\'", $content);
            $content = str_replace('"', '\"', $content);
            DB::update("
                update home
                set content = '{$content}'
                where id = 1
            ");
            return redirect('home');
        } else {
            return redirect('/');
        }
    }
}
