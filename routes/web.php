<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserScoreController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\ContentViewerController;

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/quiz/builder', [ContentController::class, 'quizMaker'])->name('quiz.create');
    Route::post('/quiz/store', [UploadController::class, 'quize.store']);
    
    Route::get('/content/{id}', [ContentViewerController::class, 'show'])->name('content.view');
    Route::get('/content/{id}/{tab}', [ContentViewerController::class, 'showTab'])->name('content.tab');

    Route::get('/user-scores', [UserScoreController::class, 'index'])->name('user-scores.index');
    Route::get('/user-scores/export', [UserScoreController::class, 'exportCSV'])->name('user-scores.export');
    Route::get('/user-scores/{user}', [UserScoreController::class, 'show'])->name('user-scores.show');
    Route::get('/user-scores/{user}/export', [UserScoreController::class, 'exportUserCSV'])->name('user-scores.user.export');

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/activity-logs/user/{user}', [ActivityLogController::class, 'show'])->name('activity-logs.show');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/edit/{user}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{user}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/permissions/{role}', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::post('/roles/update-permissions/{role}', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

    Route::get('/create', [UploadController::class, 'uploadForm'])->name('content.create');

    Route::get('/user-management', [UserManagementController::class, 'index'])->name('users');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('user.create');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('user.store');
    Route::get('/user-management/{user}/edit', [UserManagementController::class, 'edit'])->name('user.edit');
    Route::put('/user-management/{user}', [UserManagementController::class, 'update'])->name('user.update');
    Route::delete('/user-management/{user}', [UserManagementController::class, 'destroy'])->name('user.destroy');
    Route::post('/user-management/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('user.resetPassword');
    Route::post('/user-management/{user}/suspend', [UserManagementController::class, 'suspend'])->name('user.suspend');
    
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /** API */
    Route::get('/api/permissions/{role}', [PermissionController::class, 'getPermissions']);
    Route::post('/api/permissions/{role}', [PermissionController::class, 'updatePermissions']);
    Route::get('/api/users', [UserManagementController::class, 'search']);
});

require __DIR__.'/auth.php';
