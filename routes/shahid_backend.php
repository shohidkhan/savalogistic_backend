<?php

use App\Http\Controllers\UnloadingPriceControllerController;
use App\Http\Controllers\Web\Backend\Annex\AnnexRateController;
use App\Http\Controllers\Web\Backend\ApplyJob\ApplyJobController;
use App\Http\Controllers\Web\Backend\Award\AwardController;
use App\Http\Controllers\Web\Backend\Blog\BlogController;
use App\Http\Controllers\Web\Backend\Category\CategoryController;
use App\Http\Controllers\Web\Backend\Certificate\CertificateController;
use App\Http\Controllers\Web\Backend\CMR\CMRController;
use App\Http\Controllers\Web\Backend\CMS\About\AboutController;
use App\Http\Controllers\Web\Backend\CMS\SAVA\SAVAController;
use App\Http\Controllers\Web\Backend\Compliance\ComplianceController;
use App\Http\Controllers\Web\Backend\Contact\ContactController;
use App\Http\Controllers\Web\Backend\Deviation\DeviationController;
use App\Http\Controllers\Web\Backend\Job\JobController;
use App\Http\Controllers\Web\Backend\LDM\LDMController;
use App\Http\Controllers\Web\Backend\LoadingArea\LoadingAreaController;
use App\Http\Controllers\Web\Backend\LoadingZone\LoadingZoneController;
use App\Http\Controllers\Web\Backend\OurHistory\OurHistoryController;
use App\Http\Controllers\Web\Backend\PickupCost\PickupCostController;
use App\Http\Controllers\Web\Backend\RomaniaPickUpCost\RomaniaPickUpCostController;
use App\Http\Controllers\Web\Backend\Sector\SectorController;
use App\Http\Controllers\Web\Backend\ShippingRateController;
use App\Http\Controllers\Web\Backend\Team\TeamController;
use App\Http\Controllers\Web\Backend\TransportNotice\TransportNoticeController;
use App\Http\Controllers\Web\Backend\TransportRegulation\TransportRegulationController;
use App\Http\Controllers\Web\Backend\TransportRestriction\TransportRestrictionController;
use App\Http\Controllers\Web\Backend\UnloadingZone\UnloadingZoneController;
use App\Http\Controllers\Web\Backend\UnloadingArea\UnloadingAreaController;
use Illuminate\Support\Facades\Route;

Route::prefix('/cms')->name('admin.cms.')->group(function(){
    Route::controller(AboutController::class)->prefix('/about')->name('about.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/store','store')->name('store');
    });
    Route::controller(SAVAController::class)->prefix('/sava')->name('sava.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/store','store')->name('store');
    });


});

Route::resource('/teams', TeamController::class)->names('admin.teams');
Route::post('/teams/status/{id}', [TeamController::class, 'status'])->name('admin.teams.status');

// our history routes

Route::resource('/our_history', OurHistoryController::class)->names('admin.our_history');
Route::post('/our_history/status/{id}', [OurHistoryController::class, 'status'])->name('admin.our_history.status');

//certificate routes
Route::resource('/certificates', CertificateController::class)->names('admin.certificates');
Route::post('/certificates/status/{id}', [CertificateController::class, 'status'])->name('admin.certificates.status');


// Award routes

Route::resource('/awards',AwardController::class)->names('admin.awards');
Route::post('/awards/status/{id}', [AwardController::class, 'status'])->name('admin.award.status');

//category routes

Route::resource('/category',CategoryController::class)->names('admin.category');
Route::post('/category/status/{id}', [CategoryController::class, 'status'])->name('admin.category.status');


//blog routes

Route::resource('/blog',BlogController::class)->names('admin.blog');
Route::post('/blog/status/{id}', [BlogController::class, 'status'])->name('admin.blog.status');


// job routes

Route::resource('/job',JobController::class)->names('admin.job');
Route::post('/job/status/{id}', [JobController::class, 'status'])->name('admin.job.status');

Route::controller(ContactController::class)->group(function(){
    Route::get('/contacts','index')->name('admin.contact.index');
    Route::get('/contact/{id}','edit')->name('admin.contact.edit');
    Route::post('/contact/{id}/delete','destroy')->name('admin.contact.destroy');
});

Route::controller(ApplyJobController::class)->group(function(){
    Route::get('/applyJobs','index')->name('admin.apply_job.index');
    Route::get('/applyJobs/{id}','edit')->name('admin.apply_job.edit');
    Route::post('/applyJobs/{id}/update','update')->name('admin.apply_job.update');
    Route::post('/applyJobs/{id}/delete','destroy')->name('admin.apply_job.destroy');
});

Route::resource('/sector',SectorController::class)->names('admin.sector');
Route::post('/sector/status/{id}', [SectorController::class, 'status'])->name('admin.sector.status');
Route::get('/company/delete/{id}',[SectorController::class,'companyDelete'])->name('admin.company.delete');
Route::get('/company/edit/{id}',[SectorController::class,'companyEdit'])->name('admin.company.edit');
Route::post('/company/update/{id}',[SectorController::class,'companyUpdate'])->name('admin.company.update');

//Transport Restrictions Routes
Route::resource('/transport-restriction',TransportRestrictionController::class)->names('admin.transport-restriction');
Route::post('/transport-restriction/status/{id}', [TransportRestrictionController::class, 'status'])->name('admin.transport-restriction.status');

//Transport Regulation routes

Route::resource('/transport-regulation',TransportRegulationController::class)->names('admin.transport-regulation');
Route::post('/transport-regulation/status/{id}', [TransportRegulationController::class, 'status'])->name('admin.transport-regulation.status');

//compliance routes
Route::resource('/compliance',ComplianceController::class)->names('admin.compliance');
Route::post('/compliance/status/{id}', [ComplianceController::class, 'status'])->name('admin.compliance.status');
//cmr convention routes
Route::resource('/cmr',CMRController::class)->names('admin.cmr');
Route::post('/cmr/status/{id}', [CMRController::class, 'status'])->name('admin.cmr.status');



Route::resource('/transport-notice',TransportNoticeController::class)->names('admin.transport_notice');
Route::post('/transport-notice/status/{id}', [TransportNoticeController::class, 'status'])->name('admin.transport_notice.status');


Route::resource('/annex-rate',AnnexRateController::class)->names('admin.annex_rate');

Route::post('/annex-rate/status/{id}', [AnnexRateController::class, 'status'])->name('admin.annex_rate.status');

//loading Zone routes
Route::resource('/loading-zone',LoadingZoneController::class)->names('admin.loading_zone');
Route::post('/loading-zone/status/{id}', [LoadingZoneController::class, 'status'])->name('admin.loading_zone.status');
//loading Zone routes
Route::resource('/unloading-zone',UnloadingZoneController::class)->names('admin.unloading_zone');
Route::post('/unloading-zone/status/{id}', [UnloadingZoneController::class, 'status'])->name('admin.unloading_zone.status');

//loading area routes
Route::resource('/loading-area',LoadingAreaController::class)->names('admin.loading_area');
Route::post('/loading-area/status/{id}', [LoadingAreaController::class, 'status'])->name('admin.loading_area.status');

//loading area routes
Route::resource('/unloading-area',UnloadingAreaController::class)->names('admin.unloading_area');
Route::post('/unloading-area/status/{id}', [UnloadingAreaController::class, 'status'])->name('admin.unloading_area.status');


//ldm routes
Route::resource('/ldm',LDMController::class)->names('admin.ldm');
Route::post('/ldm/status/{id}', [LDMController::class, 'status'])->name('admin.ldm.status');
//ldm routes
Route::resource('/pickup-cost',PickupCostController::class)->names('admin.pickup_cost');
Route::post('/pickup-cost/status/{id}', [PickupCostController::class, 'status'])->name('admin.pickup_cost.status');

//ldm routes
Route::resource('/ro-pickup-cost',RomaniaPickUpCostController::class)->names('admin.ro_pickup_cost');
Route::post('/ro-pickup-cost/status/{id}', [RomaniaPickUpCostController::class, 'status'])->name('admin.ro_pickup_cost.status');

Route::get('/deviation',[DeviationController::class,'index'])->name('admin.deviation.index');
Route::post('/deviation',[DeviationController::class,'update'])->name('admin.deviation.update');



// unloading price controller routes
Route::resource('/unloading-price', UnloadingPriceControllerController::class)->names('admin.unloading_price');
Route::post('/unloading-price/status/{id}', [UnloadingPriceControllerController::class, 'status'])->name('admin.unloading_price.status');
