<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\MerchantTicketController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTaskController;
use Illuminate\Support\Facades\Route;

Route::resource('ticket', TicketController::class);
Route::get('/ticket/print/{id}', [TicketController::class, 'view_pdf'])->name('ticket.print');

Route::get('report/manager', [EvaluationController::class, 'manager'])->name('managerReport');
Route::get('report/technicalSupport', [EvaluationController::class, 'technicalSupport'])->name('tsReport');

Route::resource('ticketTask', TicketTaskController::class);
Route::get('/ticketTask/print/{id}', [TicketTaskController::class, 'view_pdf'])->name('ticketTask.print');

Route::resource('merchantTicket', MerchantTicketController::class);
Route::put('/merchantTicket/comment/{id}', [MerchantTicketController::class, 'comment'])->name('ticket.comment');
Route::get('/merchantTicket/print/{id}', [MerchantTicketController::class, 'view_pdf'])->name('merchantTicket.print');

Route::get('/', [SessionController::class, 'home']);
Route::get('/login/employee', [SessionController::class, 'employeeLogin']);
Route::get('/login/merchant', [SessionController::class, 'merchantLogin']);
Route::post('/session/login', [SessionController::class, 'login']);
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
Route::post('/send-otp', [SessionController::class, 'sendOtp']);
Route::post('/otpVerification', [SessionController::class, 'loginWithOtp']);
Route::get('/otp-verification', [SessionController::class, 'inputOtp']);
