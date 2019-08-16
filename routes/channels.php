<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// nuestro propio callback de autorización
// $user es el usuario que ha iniciado sesión
// $id, o los demas son los parámetros que se le envia al canal
Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id; // cada usuario iniciado en sesión puede esuchar su propido canal
});

Broadcast::channel('messenger', function ($user) {
    return [
        'id' => $user->id
    ];
});