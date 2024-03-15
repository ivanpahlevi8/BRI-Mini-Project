<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UserController;
use App\Models\Absensi;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('home');

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('/')->middleware(['role:admin,pj'])->group(function(){
    // create to create code
    Route::post('/create-code', [CodeController::class, 'store']);

    /**
     * Route to handle kelas
     */
    Route::get('/all-kelas', [KelasController::class, 'index']);

    Route::get('/add-kelas', [KelasController::class, 'create']);

    Route::post('/add-kelas', [KelasController::class, 'store']);

    Route::get('/update-kelas/{kelas}', [KelasController::class, 'showUpdate']);

    Route::post('/update-kelas', [KelasController::class, 'update']);

    Route::get('/delete-kelas/{kelas}', [KelasController::class, 'destroy']);


    // route to add user
    Route::get('/add-user', [UserController::class, 'index']);

    // route to handle add user
    Route::post('/add-user', [UserController::class, 'addAsisten']);

    Route::get('/update-user/{user}', [UserController::class, 'showUpdateAssisten']);

    Route::get('/all-user', [UserController::class, 'getAllUser']);

    Route::post('/update-user', [UserController::class, 'updateAssisten']);

    Route::get('/delete-user/{user}', [UserController::class, 'removeAssisten']);


    /**
     * Route to handle materi
     */
    Route::get('/all-materi', [MateriController::class, 'index']);

    Route::get('/add-materi', [MateriController::class, 'create']);

    Route::post('/add-materi', [MateriController::class, 'store']);

    Route::get('/update-materi/{materi}', [MateriController::class, 'edit']);

    Route::post('/update-materi', [MateriController::class, 'update']);

    Route::get('/delete-materi/{materi}', [MateriController::class, 'destroy']);

    // show all absence
    Route::get('/all-absen', [AbsensiController::class, 'allAbsensi']);
});

// route for absence
Route::post('/check-in', [AbsensiController::class, 'doCheckin']);

Route::post('/check-out', [AbsensiController::class, 'doCheckout']);

// route to show absensi as user
Route::get('/dashboard', [AbsensiController::class, 'showAbsensi'])->middleware('auth');

// route to show current user absensi
Route::get('/curr-absen', [AbsensiController::class, 'currentUserAbsensi']);

Route::get('/print-absen', [AbsensiController::class, 'exportExcel']);
