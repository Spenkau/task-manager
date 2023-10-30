<?php

use App\Broadcasting\ChatChannel;
use App\Broadcasting\TaskChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('public', function () {
    return true;
});

Broadcast::channel('task-channel', TaskChannel::class);

