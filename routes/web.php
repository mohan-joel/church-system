<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\YouthController;
use App\Http\Controllers\FellowshipController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;

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

Route::get('/', function () {
    $church = DB::table('users')->where('id',1)->value('church_name');
    $logo = DB::table('users')->where('id',1)->value('church_logo');
    $year = date('Y');
    return view('welcome',compact('church','logo','year'));
});

Route::get('/login',[AuthController::class,'login_view'])->name('login_view')->middleware('guest');
Route::post('/login',[AuthController::class,'login'])->middleware('guest');

Route::get('/register',[AuthController::class,'register_view'])->name('register_view')->middleware('guest');
Route::post('/register',[AuthController::class,'register'])->name('register_user')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware'=>['web','checkUser']],function(){
    Route::get('/user/dashboard',[AuthController::class,'dashboard'])->name('user-dashboard');
    Route::get('/show-youths',[YouthController::class,'show'])->name('showYouths');
    Route::post('/add-youths',[YouthController::class,'add'])->name('addYouths');
    Route::get('/delete-youth/{id}',[YouthController::class,'delete'])->name('deleteYouth');
    Route::get('/get-youth-data/{id}',[YouthController::class,'getData'])->name('getYouthDetail');
    Route::put('/update-youth',[YouthController::class,'update'])->name('updateYouth');
    Route::get('/show-fellowships',[FellowshipController::class,'show'])->name('showFellowship');
    Route::post('/add-fellowships',[FellowshipController::class,'add'])->name('addFellowship');
    Route::put('/update-fellowships',[FellowshipController::class,'update'])->name('updateFellowship');
    Route::get('/delete-fellowship/{id}',[FellowshipController::class,'delete'])->name('deleteFellowship');
    Route::get('/show-notices',[NoticeController::class,'show'])->name('showNotices');
    Route::post('/add-notices',[NoticeController::class,'add'])->name('addNotices');
    Route::get('/delete-notice/{id}',[NoticeController::class,'delete'])->name('deleteNotice');
    Route::get('/get-notice-details/{id}',[NoticeController::class,'getNoticeDetail'])->name('getNoticeDetail');
    Route::put('/update-notice',[NoticeController::class,'update'])->name('updateNotice');
    Route::get('/show-print-preview/{lead_id}/{sermon_id}',[NoticeController::class,'printPreview'])->name('showPrintPreview');
    Route::get('/show-incomes',[IncomeController::class,'show'])->name('showIncomes');
    Route::post('/add-incomes',[IncomeController::class,'add'])->name('addIncome');
    Route::get('/delete-income/{id}',[IncomeController::class,'delete'])->name('deleteIncome');
    Route::post('/add-expenditures',[ExpenditureController::class,'add'])->name('addExpenditure');
    Route::get('/show-expenditures',[ExpenditureController::class,'show'])->name('showExpenditures');
    Route::get('/delete-expenditure/{id}',[ExpenditureController::class,'delete'])->name('deleteExpenditure');
    Route::get('/get-income-detail/{id}',[IncomeController::class,'getIncomeDetail'])->name('getIncomeDetail');
    Route::put('/update-income',[IncomeController::class,'update'])->name('updateIncome');
    Route::get('/get-expenditure-detail/{id}',[ExpenditureController::class,'getExpenditureDetail'])->name('getExpenditureDetail');
    Route::put('/update-expenditure',[ExpenditureController::class,'update'])->name('updateExpenditure');
    Route::get('/youth-print-preview',[YouthController::class,'youthPrintPreview'])->name('youthPrintPreview');
    Route::get('/fellowship-print-preview',[FellowshipController::class,'fellowshipPrintPreview'])->name('fellowshipPrintPreview');
    Route::get('/notice-print-preview',[NoticeController::class,'noticePrintPreview'])->name('noticePrintPreview');
    Route::get('/income-print-preview',[IncomeController::class,'incomePrintPreview'])->name('incomePrintPreview');
    Route::get('/expenditure-print-preview',[ExpenditureController::class,'expenditurePrintPreview'])->name('expenditurePrintPreview');
    Route::get('/show-profile-setting',[DashboardController::class,'showProfileSetting'])->name('profileSetting');
    Route::get('/search-youths',[YouthController::class,'SearchYouth'])->name('searchYouth');
    Route::get('/search-fellowships',[FellowshipController::class,'SearchFellowship'])->name('searchFellowship');
    Route::get('/search-notices',[NoticeController::class,'SearchNotice'])->name('searchNotice');
    Route::get('/search-income',[IncomeController::class,'SearchIncome'])->name('searchIncome');
    Route::get('/search-expenditure',[ExpenditureController::class,'SearchExpenditure'])->name('searchExpenditure');
    Route::post('/update-profile-picture',[DashboardController::class,'updateProfilePic'])->name('updateProfilePic');
    Route::post('/profile-settings',[DashboardController::class,'updateProfileDetails'])->name('updateProfileSetting');
    Route::post('/update-church-logo',[DashboardController::class,'updateChurchLogo'])->name('updateChurchLogo');
    Route::post('/update-church-details',[DashboardController::class,'updateChurchDetails'])->name('updateChurchDetail');

    //Routes for meeting
    Route::get('/show-meetings',[MeetingController::class,'show'])->name('show-meetings');
    Route::post('/add-meetings',[MeetingController::class,'store'])->name('add-meetings');


    
});
