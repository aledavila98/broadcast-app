<?php

use Illuminate\Support\Facades\Route;
use App\Events\PingEvent;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/broadcast', function () {
    $message = request()->input('message', 'ping me pls');
    broadcast(new PingEvent($message));
    return response()->json(['status' => 'Ping event dispatched']);
});
