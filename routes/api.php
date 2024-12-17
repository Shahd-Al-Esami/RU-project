<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlanOrderController;
use App\Http\Controllers\Api\BlockedUserController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth api
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
//admins
Route::get('/getAllDoctors',[UserController::class,'getAllDoctors'])->middleware('auth:sanctum');
Route::get('/getDoctor/{id}',[UserController::class,'getDoctor'])->middleware('auth:sanctum');
Route::get('/getDoctorWithPatients/{id}',[UserController::class,'getDoctorWithPatients'])->middleware('auth:sanctum');
Route::delete('/softDelete/{id}',[UserController::class,'softDelete'])->middleware('auth:sanctum');
Route::get('/deletedUsers',[UserController::class,'deletedUsers'])->middleware('auth:sanctum');
Route::post('/restore/{id}',[UserController::class,'restore'])->middleware('auth:sanctum');
Route::get('/getAllPatient',[UserController::class,'getAllPatient'])->middleware('auth:sanctum');
Route::post('/isAgreeDoctor/{id}',[UserController::class,'isAgreeDoctor'])->middleware('auth:sanctum');
Route::get('/allPendingDoctors',[UserController::class,'allPendingDoctors'])->middleware('auth:sanctum');
Route::get('/countUser',[UserController::class,'countUser'])->middleware('auth:sanctum');

Route::get('/getAllPlanOrders',[PlanOrderController::class,'getAllPlanOrders'])->middleware('auth:sanctum');
Route::get('/showPlanOrder/{id}',[PlanOrderController::class,'showPlanOrder'])->middleware('auth:sanctum');
Route::get('/countPlans',[PlanOrderController::class,'countPlans'])->middleware('auth:sanctum');

Route::get('/getBlockedUsers',[BlockedUserController::class,'getBlockedUsers'])->middleware('auth:sanctum');
Route::post('/blockUser/{id}',[BlockedUserController::class,'blockUser'])->middleware('auth:sanctum');
Route::post('/disblockUser/{id}',[BlockedUserController::class,'disblockUser'])->middleware('auth:sanctum');
Route::get('/countBlockUser',[BlockedUserController::class,'countBlockUser'])->middleware('auth:sanctum');

Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->middleware('auth:sanctum');
Route::get('/monthBills',[BillController::class,'monthBills'])->middleware('auth:sanctum');
Route::get('/addBillToDoctor/{doctor_id}',[BillController::class,'addBillToDoctor'])->middleware('auth:sanctum');
Route::get('/countBill',[BillController::class,'countBill'])->middleware('auth:sanctum');

  // *****************************************************************
  //doctor

