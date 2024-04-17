<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PaymentController;

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

// User
Route::get('/', [UserController::class, 'index']);
Route::get('/user/login', [UserController::class, 'loginPage']);
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/register', [UserController::class, 'registerPage']);
Route::post('/user/register', [UserController::class, 'register']);
Route::get('/user/logout', [UserController::class, 'logout']);

Route::get('/consultation/doctor-list', [ConsultationController::class, 'getDoctorList']);
Route::get('/consultation/doctor/{doctorId}', [ConsultationController::class, 'getDoctorDetail']);
Route::post('/consultation', [ConsultationController::class, 'createConsultation']);
Route::delete('/consultation', [ConsultationController::class, 'deleteConsultation']);

Route::get('/payment/{consultId}', [PaymentController::class, 'confirmPayment']);
Route::post('/payment', [PaymentController::class, 'approvePayment']);

Route::get('/consultation/start/{consultId}', [ConsultationController::class, 'startConsultation']);
Route::get('/consultation/check/{consultId}', [ConsultationController::class, 'checkStatusConsultation']);
Route::get('/cancelConsultationConfirmation/{consultId}', [ConsultationController::class, 'cancelConsultPopup']);
