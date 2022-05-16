<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Home;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
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
        
        $posts = DB::select('
            select p.created_at, p.id, p.title, p.content, p.user_id, u.name, count(distinct l.id) as likes, count(distinct c.id) as commentsCount
            from blog_posts p
            join users u on p.user_id = u.id
            left join likes l on p.id = l.post_id
            left join comments c on p.id = c.post_id
            group by p.id, p.title, p.content, u.name, p.created_at, p.user_id
            order by p.created_at desc
        ');

        $comments = DB::select('
            select c.id, c.post_id, c.comment, c.created_at, u.name
            from comments c
            join users u on c.user_id = u.id
        ');

        $user = auth()->user();
        $userLikes = DB::select('
            select post_id from likes
            where user_id = ' . $user->id . '
        ');

        $likeArr = [];
        foreach ($userLikes as $like) {
            array_push($likeArr, $like->post_id);
        }

        return view('home')
            ->with(['content' => $content[0]->content])
            ->with('posts', $posts)
            ->with('comments', $comments)
            ->with('likes', $likeArr);
    })->name('home')->middleware('verified');

    Route::get('/appointments', function () {
        if (auth()->user()->admin) {
            $upcomingAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 1 and completed = 0
                order by a.appointment_date
            ');
            $requestedAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 0 and completed = 0
                order by a.appointment_date
            ');
            $completedAppointments = DB::select('
                select a.id, a.user_id, phone, service, appointment_date, description, confirmed, completed, u.name AS user_name, s.service_name AS service_name
                from appointments a
                join users u on a.user_id = u.id
                join services s on a.service = s.id
                where confirmed = 1 and completed = 1
                order by a.appointment_date
            ');
            return view('appointments')->with('upcomingAppointments', $upcomingAppointments)
                ->with('requestedAppointments', $requestedAppointments)
                ->with('completedAppointments', $completedAppointments); 
        } else {
        $appointments = DB::select("
                SELECT phone, appointment_date, service, description, confirmed, completed, service_name 
                FROM appointments
                JOIN services ON appointments.service = services.id
                WHERE user_id = " . auth()->user()->id . "
                ORDER BY appointment_date
            ");
            return view('appointments')->with('appointments', $appointments)
            ->with('services', Service::all());
        }
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

    Route::post('/complete-appointment', function () {
        $appointment = Appointment::find(request('id'));
        $appointment->completed = true;
        $appointment->save();
        return redirect('/appointments');
    })->name('complete-appointment');

    Route::post('/confirm-appointment' , function () {
        $appointment = Appointment::find(request('id'));
        $appointment->confirmed = true;
        $appointment->save();
        return redirect('/appointments');
    })->name('confirm-appointment');

    Route::post('/remove-appointment' , function () {
        $appointment = Appointment::find(request('id'));
        $appointment->delete();
        return redirect('/appointments');
    })->name('remove-appointment');
    
    Route::get('/home-editor', function () {
        if (auth()->user()->admin) {
            $content = DB::select("
            select content from home where id = 1
        ");
            return view('home-editor')->with(['content' => $content[0]->content]);
        } else {
            return redirect('/');
        }
    })->name('home-editor')->middleware('verified');

    Route::get('/blog', function () {
        $posts = DB::select('
            select p.created_at, p.id, p.title, p.content, p.user_id, u.name, count(distinct l.id) as likes, count(distinct c.id) as commentsCount
            from blog_posts p
            join users u on p.user_id = u.id
            left join likes l on p.id = l.post_id
            left join comments c on p.id = c.post_id
            group by p.id, p.title, p.content, u.name, p.created_at, p.user_id
            order by p.created_at desc
        ');

        $comments = DB::select('
            select c.id, c.post_id, c.comment, c.created_at, u.name
            from comments c
            join users u on c.user_id = u.id
        ');

        $user = auth()->user();
        $userLikes = DB::select('
            select post_id from likes
            where user_id = ' . $user->id . '
        ');

        $likeArr = [];
        foreach ($userLikes as $like) {
            array_push($likeArr, $like->post_id);
        }

        return view('blog')->with('posts', $posts)
            ->with('comments', $comments)
            ->with('likes', $likeArr);
    })->name('blog')->middleware('verified');

    Route::post('/create-post', function (Request $request) {
        if (auth()->user()->admin) {
            $validated = $request->validate([
                'title' => 'required|min:3',
                'content' => 'required|min:10'
            ]);
            BlogPost::create($validated + ['user_id' => auth()->id()]);
            return redirect('blog#post' . BlogPost::all()->last()->id);
        } else {
            return redirect('/');
        }
    })->name('create-post')->middleware('verified');

    Route::post('/edit-post', function (Request $request) {
        if (auth()->user()->admin) {
            $post = BlogPost::find($request->post_id);
            return view('edit-post')->with('post', $post)
            ->with('route', $request->route);
        } else {
            return redirect('/');
        }
    })->name('edit-post');

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

    Route::post('/edit-home', function (Request $request) {
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
    })->name('edit-home')->middleware('verified');

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
