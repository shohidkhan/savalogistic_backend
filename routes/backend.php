<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\FaqController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\OurServiceController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//FAQ Routes
Route::controller(FaqController::class)->group(function () {
    Route::get('/faqs', 'index')->name('admin.faqs.index');
    Route::get('/faqs/create', 'create')->name('admin.faqs.create');
    Route::post('/faqs/store', 'store')->name('admin.faqs.store');
    Route::get('/faqs/edit/{id}', 'edit')->name('admin.faqs.edit');
    Route::post('/faqs/update/{id}', 'update')->name('admin.faqs.update');
    Route::post('/faqs/status/{id}', 'status')->name('admin.faqs.status');
    Route::post('/faqs/destroy/{id}', 'destroy')->name('admin.faqs.destroy');
});


//Our Services 
Route::controller(OurServiceController::class)->group(function () {
    Route::get('/services', 'index')->name('admin.services.index');
    Route::get('/services/create', 'create')->name('admin.services.create');
    Route::post('/services/store', 'store')->name('admin.services.store');
    Route::get('/services/edit/{id}', 'edit')->name('admin.services.edit');
    Route::post('/services/update/{id}', 'update')->name('admin.services.update');
    Route::post('/services/status/{id}', 'status')->name('admin.services.status');
    Route::post('/services/destroy/{id}', 'destroy')->name('admin.services.destroy');

    Route::get('/services-feature/destroy/{id}', 'destroyFeature')->name('admin.our-service-feature.delete');
    Route::get('/services-feature/edit/{id}', 'editFeature')->name('admin.our-service-feature.edit');
    Route::post('/services-feature/update/{id}', 'updateFeature')->name('admin.services-feature.update');
});
