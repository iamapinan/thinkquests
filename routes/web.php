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
use App\Http\Controllers\OrganizationController;

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/quiz/builder', [ContentController::class, 'quizMaker'])->name('quiz.create');
    Route::post('/content/save', [UploadController::class, 'saveContent'])->name('content.save');
    Route::post('/content/store', [UploadController::class, 'store'])->name('content.store');
    
    Route::get('/content/{id}', [ContentViewerController::class, 'show'])->name('content.view');
    Route::get('/content/{id}/{tab}', [ContentViewerController::class, 'showTab'])->name('content.tab');

    Route::delete('/content/{id}', [HomeController::class, 'destroy'])->name('content.destroy');

    Route::get('/user-scores', [UserScoreController::class, 'index'])->name('user-scores.index');
    Route::get('/user-scores/export', [UserScoreController::class, 'exportCSV'])->name('user-scores.export');
    Route::get('/user-scores/{user}', [UserScoreController::class, 'show'])->name('user-scores.show');
    Route::get('/user-scores/{user}/export', [UserScoreController::class, 'exportUserCSV'])->name('user-scores.user.export');
    // Create edit score route
    Route::patch('/user-scores/{user}/edit', [UserScoreController::class, 'edit'])->name('user-scores.edit');
    Route::post('/user-scores/{user}/save', [UserScoreController::class, 'save'])->name('user-scores.save');

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/activity-logs/user/{user}', [ActivityLogController::class, 'show'])->name('activity-logs.show');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/edit/{user}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{user}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/permissions/{role}', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::post('/roles/update-permissions/{role}', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

    Route::get('/create', [UploadController::class, 'uploadForm'])->name('content.create');
    Route::resource('organizations', OrganizationController::class);
    Route::get('organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('organization/create', [OrganizationController::class, 'create'])->name('organization.create');
    Route::post('organization/store', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('organization/{organization}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::put('organization/{organization}', [OrganizationController::class, 'update'])->name('organization.update');
    Route::delete('organization/{organization}', [OrganizationController::class, 'destroy'])->name('organization.destroy');
    Route::get('/users', [UserManagementController::class, 'index'])->name('users');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('user.create');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('user.destroy');
    Route::get('/users/export', [UserManagementController::class, 'exportCSV'])->name('user.export');
    Route::post('/users/import', [UserManagementController::class, 'importCsv'])->name('user.import');
    Route::post('/users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('user.resetPassword');
    Route::post('/users/{user}/suspend', [UserManagementController::class, 'suspend'])->name('user.suspend');
    Route::post('/users', [UserManagementController::class, 'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('user.edit');
    Route::post('/users/{user}', [UserManagementController::class, 'update'])->name('user.update');
    
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
