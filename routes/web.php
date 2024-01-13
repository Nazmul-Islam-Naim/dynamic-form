<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UrlShortenerController;
use App\Models\Category;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RoleController::class);

    Route::get('users', function () {
        return view('user', [
            'users' => User::all()
        ]);
    })->name('users');

    Route::get('organizations', function () {
        return view('organization', [
            'organizations' => Organization::all()
        ]);
    })->name('organizations');

    Route::get('categories', function () {
        return view('category', [
            'categories' => Category::all()
        ]);
    })->name('categories');

    Route::resource('forms', FormController::class);
    Route::get('formSubmissions', [FormSubmissionController::class, 'index'])->name('formSubmissions.index');
    Route::get('formSubmissions/form/{id}', [FormSubmissionController::class, 'form'])->name('formSubmissions.form');
    Route::post('formSubmissions/store', [FormSubmissionController::class, 'store'])->name('formSubmissions.store');
});

require __DIR__.'/auth.php';
