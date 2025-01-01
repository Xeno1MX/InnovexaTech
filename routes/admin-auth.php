<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['guest:admin'])->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])
                ->name('admin.logout');

    Route::resource('subjects', SubjectController::class);
    Route::resource('spaces', SpaceController::class);
    Route::resource('lecturers', LecturerController::class);

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('password-admin', [PasswordController::class, 'updateAdmin'])->name('admin.password.update');

    // Admin Booking Approval Page
    Route::get('/bookings/approval', [BookingController::class, 'showApprovalPage'])->name('admin.bookings.approval');

    // Approve and Reject Actions
    Route::patch('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::patch('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

});
