<?php
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');

// ── Admin Auth ────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/',            fn () => redirect()->route('admin.login'));
    Route::get('login',        [AdminController::class, 'loginForm'])->name('login')->middleware('guest');
    Route::post('login',       [AdminController::class, 'login'])->name('login.post')->middleware('guest');
    Route::post('logout',      [AdminController::class, 'logout'])->name('logout');

    // ── Protected ─────────────────────────────────────────────────────────────
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Projects
        Route::get    ('projects',              [AdminController::class, 'projectsIndex'])  ->name('projects.index');
        Route::get    ('projects/create',       [AdminController::class, 'projectsCreate']) ->name('projects.create');
        Route::post   ('projects',              [AdminController::class, 'projectsStore'])  ->name('projects.store');
        Route::get    ('projects/{project}/edit',   [AdminController::class, 'projectsEdit'])   ->name('projects.edit');
        Route::put    ('projects/{project}',        [AdminController::class, 'projectsUpdate'])  ->name('projects.update');
        Route::delete ('projects/{project}',        [AdminController::class, 'projectsDestroy']) ->name('projects.destroy');

        // Skills
        Route::get    ('skills',               [AdminController::class, 'skillsIndex'])  ->name('skills.index');
        Route::get    ('skills/create',        [AdminController::class, 'skillsCreate']) ->name('skills.create');
        Route::post   ('skills',               [AdminController::class, 'skillsStore'])  ->name('skills.store');
        Route::get    ('skills/{skill}/edit',  [AdminController::class, 'skillsEdit'])   ->name('skills.edit');
        Route::put    ('skills/{skill}',       [AdminController::class, 'skillsUpdate']) ->name('skills.update');
        Route::delete ('skills/{skill}',       [AdminController::class, 'skillsDestroy'])->name('skills.destroy');

        // Experiences
        Route::get    ('experiences',                      [AdminController::class, 'experiencesIndex'])  ->name('experiences.index');
        Route::get    ('experiences/create',               [AdminController::class, 'experiencesCreate']) ->name('experiences.create');
        Route::post   ('experiences',                      [AdminController::class, 'experiencesStore'])  ->name('experiences.store');
        Route::get    ('experiences/{experience}/edit',    [AdminController::class, 'experiencesEdit'])   ->name('experiences.edit');
        Route::put    ('experiences/{experience}',         [AdminController::class, 'experiencesUpdate']) ->name('experiences.update');
        Route::delete ('experiences/{experience}',         [AdminController::class, 'experiencesDestroy'])->name('experiences.destroy');

        // Education
        Route::get    ('education',                    [AdminController::class, 'educationIndex'])  ->name('education.index');
        Route::get    ('education/create',             [AdminController::class, 'educationCreate']) ->name('education.create');
        Route::post   ('education',                    [AdminController::class, 'educationStore'])  ->name('education.store');
        Route::get    ('education/{education}/edit',   [AdminController::class, 'educationEdit'])   ->name('education.edit');
        Route::put    ('education/{education}',        [AdminController::class, 'educationUpdate']) ->name('education.update');
        Route::delete ('education/{education}',        [AdminController::class, 'educationDestroy'])->name('education.destroy');

        // Certifications
        Route::get    ('certifications',                           [AdminController::class, 'certificationsIndex'])  ->name('certifications.index');
        Route::get    ('certifications/create',                    [AdminController::class, 'certificationsCreate']) ->name('certifications.create');
        Route::post   ('certifications',                           [AdminController::class, 'certificationsStore'])  ->name('certifications.store');
        Route::get    ('certifications/{certification}/edit',      [AdminController::class, 'certificationsEdit'])   ->name('certifications.edit');
        Route::put    ('certifications/{certification}',           [AdminController::class, 'certificationsUpdate']) ->name('certifications.update');
        Route::delete ('certifications/{certification}',           [AdminController::class, 'certificationsDestroy'])->name('certifications.destroy');

        // Testimonials
        Route::get    ('testimonials',                       [AdminController::class, 'testimonialsIndex'])  ->name('testimonials.index');
        Route::get    ('testimonials/create',                [AdminController::class, 'testimonialsCreate']) ->name('testimonials.create');
        Route::post   ('testimonials',                       [AdminController::class, 'testimonialsStore'])  ->name('testimonials.store');
        Route::get    ('testimonials/{testimonial}/edit',    [AdminController::class, 'testimonialsEdit'])   ->name('testimonials.edit');
        Route::put    ('testimonials/{testimonial}',         [AdminController::class, 'testimonialsUpdate']) ->name('testimonials.update');
        Route::delete ('testimonials/{testimonial}',         [AdminController::class, 'testimonialsDestroy'])->name('testimonials.destroy');

        // Settings
        Route::get  ('settings', [AdminController::class, 'settingsIndex'])  ->name('settings.index');
        Route::post ('settings', [AdminController::class, 'settingsUpdate']) ->name('settings.update');
    });
});

