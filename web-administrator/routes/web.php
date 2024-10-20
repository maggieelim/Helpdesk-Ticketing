<?php


use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MerchantTicketController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTaskController;
use Illuminate\Support\Facades\Route;


Route::resource('employee', EmployeeController::class);
Route::put('employee/{id}/setInactive', [EmployeeController::class, 'inactive'])->name('setInactive');
Route::put('employee/{id}/setActive', [EmployeeController::class, 'active'])->name('setActive');
Route::resource('ticket', TicketController::class);
Route::resource('ticketTask', TicketTaskController::class);
Route::resource('merchantTicket', MerchantTicketController::class);

Route::get('/', [SessionController::class, 'home']);
Route::get('/login/employee', [SessionController::class, 'employeeLogin']);
Route::get('/login/merchant', [SessionController::class, 'merchantLogin']);
Route::post('/session/login', [SessionController::class, 'login']);
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
Route::post('/send-otp', [SessionController::class, 'sendOtp']);
Route::post('/otpVerification', [SessionController::class, 'loginWithOtp']);
Route::get('/otp-verification', [SessionController::class, 'inputOtp']);
