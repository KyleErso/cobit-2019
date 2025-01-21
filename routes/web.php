<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DfController;
use App\Http\Controllers\Df2Controller;
use App\Http\Controllers\Df3Controller;
use App\Http\Controllers\Df4Controller;
use App\Http\Controllers\Df5Controller;
use App\Http\Controllers\Df6Controller;
use App\Http\Controllers\Df7Controller;
use App\Http\Controllers\Df8Controller;
use App\Http\Controllers\Df9Controller;
use App\Http\Controllers\Df10Controller;

// Redirect ke halaman login
Route::get('/', function () {return redirect()->route('login');});

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk pendaftaran
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route home yang dilindungi
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Route untuk Design Factor 1
Route::get('/df1/form/{id}', [DfController::class, 'showDesignFactorForm'])->name('df1.form')->middleware('auth'); // Menampilkan form
Route::post('/df1/store', [DfController::class, 'store'])->name('df1.store')->middleware('auth'); // Menyimpan data
Route::get('/df1/output/{id}', [DfController::class, 'showOutput'])->name('df1.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 2
Route::get('/df2/form/{id}', [Df2Controller::class, 'showDesignFactor2Form'])->name('df2.form')->middleware('auth'); // Menampilkan form
Route::post('/df2/store', [Df2Controller::class, 'store'])->name('df2.store')->middleware('auth'); // Menyimpan data
Route::get('/df2/output/{id}', [Df2Controller::class, 'showOutput'])->name('df2.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 3
Route::get('/df3/form/{id}', [Df3Controller::class, 'showDesignFactor3Form'])->name('df3.form')->middleware('auth'); // Menampilkan form
Route::post('/df3/store', [Df3Controller::class, 'store'])->name('df3.store')->middleware('auth'); // Menyimpan data
Route::get('/df3/output/{id}', [Df3Controller::class, 'showOutput'])->name('df3.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 4
Route::get('/df4/form/{id}', [Df4Controller::class, 'showDesignFactor4Form'])->name('df4.form')->middleware('auth'); // Menampilkan form
Route::post('/df4/store', [Df4Controller::class, 'store'])->name('df4.store')->middleware('auth'); // Menyimpan data
Route::get('/df4/output/{id}', [Df4Controller::class, 'showOutput'])->name('df4.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 5
Route::get('/df5/form/{id}', [Df5Controller::class, 'showDesignFactor5Form'])->name('df5.form')->middleware('auth'); // Menampilkan form
Route::post('/df5/store', [Df5Controller::class, 'store'])->name('df5.store')->middleware('auth'); // Menyimpan data
Route::get('/df5/output/{id}', [Df5Controller::class, 'showOutput'])->name('df5.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 6
Route::get('/df6/form/{id}', [Df6Controller::class, 'showDesignFactor6Form'])->name('df6.form')->middleware('auth'); // Menampilkan form
Route::post('/df6/store', [Df6Controller::class, 'store'])->name('df6.store')->middleware('auth'); // Menyimpan data
Route::get('/df6/output/{id}', [Df6Controller::class, 'showOutput'])->name('df6.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 7
Route::get('/df7/form/{id}', [Df7Controller::class, 'showDesignFactor7Form'])->name('df7.form')->middleware('auth'); // Menampilkan form
Route::post('/df7/store', [Df7Controller::class, 'store'])->name('df7.store')->middleware('auth'); // Menyimpan data
Route::get('/df7/output/{id}', [Df7Controller::class, 'showOutput'])->name('df7.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 8
Route::get('/df8/form/{id}', [Df8Controller::class, 'showDesignFactor8Form'])->name('df8.form')->middleware('auth'); // Menampilkan form
Route::post('/df8/store', [Df8Controller::class, 'store'])->name('df8.store')->middleware('auth'); // Menyimpan data
Route::get('/df8/output/{id}', [Df8Controller::class, 'showOutput'])->name('df8.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 9
Route::get('/df9/form/{id}', [Df9Controller::class, 'showDesignFactor9Form'])->name('df9.form')->middleware('auth'); // Menampilkan form
Route::post('/df9/store', [Df9Controller::class, 'store'])->name('df9.store')->middleware('auth'); // Menyimpan data
Route::get('/df9/output/{id}', [Df9Controller::class, 'showOutput'])->name('df9.output')->middleware('auth'); // Menampilkan output

// Route untuk Design Factor 10
Route::get('/df10/form/{id}', [Df10Controller::class, 'showDesignFactor10Form'])->name('df10.form')->middleware('auth'); // Menampilkan form
Route::post('/df10/store', [Df10Controller::class, 'store'])->name('df10.store')->middleware('auth'); // Menyimpan data
Route::get('/df10/output/{id}', [Df10Controller::class, 'showOutput'])->name('df10.output')->middleware('auth'); // Menampilkan output
