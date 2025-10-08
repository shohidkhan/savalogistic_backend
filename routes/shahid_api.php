<?php

use App\Http\Controllers\Api\Blog\BlogController;
use App\Http\Controllers\Api\CalculateShippingPriceController;
use App\Http\Controllers\Api\Certification\CertificationController;
use App\Http\Controllers\Api\CMR\CMRController;
use App\Http\Controllers\Api\CMS\AboutController;
use App\Http\Controllers\Api\Contact\ContactController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\job\JobController;
use App\Http\Controllers\Api\Sector\SectorController;
use App\Http\Controllers\Api\TransportNotice\TransportNoticeController;
use App\Http\Controllers\Api\TransportRegulation\TransportRegulationController;
use App\Http\Controllers\Api\TransportRestriction\TransportRestrictionController;
use Illuminate\Support\Facades\Route;

Route::get('/get_about',[AboutController::class,'getAbout']);
//certifications routes
Route::get('/certification_data',[CertificationController::class,'getCertificationPageData']);
Route::get('/certificate/view/{id}',[CertificationController::class,'certificateView']);
Route::get('/award/view/{id}',[CertificationController::class,'awardView']);

//blog routes
Route::get('/get_blogs',[BlogController::class,'getAllBlogs']);
Route::get('/blog/details/{id}',[BlogController::class,'blogDetails']);

//job routes

Route::get('/jobs',[JobController::class,'getAllJobs']);
Route::get('/job/{id}/details',[JobController::class,'jobDetails']);

//Contact Route

Route::post('/contact',[ContactController::class,'store']);


Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/apply',[JobController::class,'applyJob']);
});


Route::get('/get_sectors',[SectorController::class,'getAllSectors']);
Route::get('/get_company/{id}',[SectorController::class,'getCompanies']);


Route::get('/holidays',[HolidayController::class,'index']);

Route::get('/countries',[CountryController::class,'index']);

Route::get('/transport-restriction',[TransportRestrictionController::class,'getTransportRestrictionData']);
Route::get('/transport-regulation',[TransportRegulationController::class,'getTransportRegulationData']);
Route::get('/cmr-convention',[CMRController::class,'index']);
Route::get('/transport-notice',[TransportNoticeController::class,'index']);



Route::post('/calculate_shipping_price',[CalculateShippingPriceController::class,'calculateShippingPrice'])->middleware('jwt.verify');
