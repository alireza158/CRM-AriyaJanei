<?php

use App\Http\Controllers\Api\ExternalUserSyncController;
use Illuminate\Support\Facades\Route;

Route::middleware('external.sync')->group(function () {
    Route::get('/external/users', [ExternalUserSyncController::class, 'index']);
});
