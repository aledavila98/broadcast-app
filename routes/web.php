<?php

use Illuminate\Support\Facades\Route;
use App\Events\PingEvent;
use App\Events\MessageEvent;
use App\Events\QueueEvent;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/broadcast', function () {
    $message = request()->input('message', 'ping me pls');
    broadcast(new PingEvent($message));
    return response()->json(['status' => 'Ping event dispatched']);
});

Route::post('/send_message', function () {
    $device = request()->input('device', 'device');
    $message = request()->input('message', 'Sending a message');
    event(new MessageEvent($device, $message));
    return response()->json(['status' => 'Message event dispatched']);
});

Route::post('/queued_message', function () {
    $message = request()->input('message', 'Sending a queued message');
    broadcast(new QueueEvent($message));
    return response()->json(['status' => 'Queued message event dispatched']);
});
