<?php

use App\Http\Controllers\UserManagementController;

Route::get('/users', [UserManagementController::class, 'search']);