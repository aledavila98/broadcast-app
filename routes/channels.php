<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\QueuedChannel;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('pingme', function() {});
Broadcast::channel('queued_testing', QueuedChannel::class);
