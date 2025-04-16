<?php

use Inertia\Inertia;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/chat', function () {
        return Inertia::render('Chat');
    })->name('chat');
    Route::get('messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::post('messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);

    Route::get('notification', function (Request $request) {
        $notification = $request->user()->notifications()->create([
            'text' => $request->text
        ]);
        $notification->user->notify(new App\Notifications\NewChat($notification));
        return ['status' => 'Notification Created'];
    })->middleware(['auth', 'verified'])->name('notification');

    Route::get('notifications', function (Request $request) {
        return Notification::where('user_id', '!=', $request->user()->id)->whereNull('viewed_at')->get();
    })->middleware(['auth', 'verified'])->name('notifications');

    Route::put('notification/{id}', function (int $id) {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update(['viewed_at' => now()]);
            return ['status' => 'Notification Updated'];
        }
        return ['status' => 'Notification Not Found'];
    })->middleware(['auth', 'verified'])->name('viewed-notification');
});
