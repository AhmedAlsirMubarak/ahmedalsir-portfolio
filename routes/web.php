<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

// Public portfolio routes
Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('projects',       ProjectController::class);
        Route::resource('experiences',    ExperienceController::class);
        Route::resource('skills',         SkillController::class);
        Route::resource('education',      EducationController::class);
        Route::resource('certifications', CertificationController::class);
        Route::resource('testimonials',   TestimonialController::class);
        Route::resource('settings',       SettingController::class)->except(['show']);
        Route::post('settings/bulk',      [SettingController::class, 'bulkUpdate'])->name('settings.bulk');
    });
});
