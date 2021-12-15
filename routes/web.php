<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\PatientDutyController;
use App\Http\Controllers\PatientRightController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/user/avatar_upload', [UserController::class, 'updateAvatar'])->name('user.update-avatar');
Route::resource('user', UserController::class);
Route::post('user/upload', [UserController::class, 'upload'])->name('user.upload');
Route::post('user/update/${id}', [UserController::class, 'update'])->name('user.update');

Route::resource('facility', FacilityController::class);
Route::post('facility/upload', [FacilityController::class, 'upload'])->name('facility.upload');
Route::post('facility/update/${id}', [FacilityController::class, 'update'])->name('facility.update');

Route::resource('mitra', MitraController::class);
Route::post('mitra/upload', [MitraController::class, 'upload'])->name('mitra.upload');
Route::post('mitra/update/${id}', [MitraController::class, 'update'])->name('mitra.update');

Route::resource('gallery', GalleryController::class);
Route::post('gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');
Route::post('gallery/update/${id}', [GalleryController::class, 'update'])->name('gallery.update');

Route::resource('doctor', DoctorController::class);
Route::post('doctor/upload', [DoctorController::class, 'upload'])->name('doctor.upload');
Route::post('doctor/update/${id}', [DoctorController::class, 'update'])->name('doctor.update');

Route::resource('post', PostController::class);
Route::post('post/upload', [PostController::class, 'upload'])->name('post.upload');
Route::post('post/update/${id}', [PostController::class, 'update'])->name('post.update');

Route::resource('video', VideoController::class);
Route::resource('category', CategoryController::class);
Route::resource('duty', PatientDutyController::class);
Route::resource('right', PatientRightController::class);
Route::resource('speciality', SpecialityController::class);


// Route::post('formSubmit', 'ImageController@formSubmit');
