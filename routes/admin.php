<?php

use App\Http\Controllers\Impayes\ImpayesController;
use App\Http\Controllers\Reminder\ReminderController;
use App\Http\Controllers\Subscriber\SubscriberController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;





Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::resource('impayes', ImpayesController::class)->middleware('user');
    Route::resource('reminder', ReminderController::class);
    Route::resource('subscriber', SubscriberController::class)->middleware('user');
    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('/print', [ImpayesController::class, 'printRec'])->name('printRec')->middleware('user');
    Route::get('/subscribers/{name}', [ImpayesController::class, 'getSubscribers'])->middleware('user');
    Route::get('/add-base', [ImpayesController::class, 'addBase'])->name('addBase')->middleware('admin');
    Route::post('/store-base', [ImpayesController::class, 'storeBase'])->name('storeBase')->middleware('admin');
    Route::get('/schedule-email', [ReminderController::class, 'getScheduleEmail'])->name('scheduleEmail')->middleware('user');
    Route::get('/contacts/{id}', [SubscriberController::class, 'getContactGroups'])->name('contacts')->middleware('user');
    Route::get('/send-email/{id}', [ReminderController::class, 'sendAnEmailNow'])->name('sendAnEmailNow')->middleware('user');
    Route::get('/get-names/{name}', [ImpayesController::class, 'getAllUniqueNames'])->name('getAllUniqueNames')->middleware('user');
});
