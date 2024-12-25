<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PlanOrderController;
use App\Http\Controllers\Api\MonthBillsController;
use App\Http\Controllers\Api\BlockedUserController;
use App\Http\Controllers\Api\DoctorInformationController;


Route::get('/home', [HomeController::class, 'index']);
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
// Route::get('/addBillToDoctor/{doctor_id}',[BillController::class,'addBillToDoctor'])->middleware('auth:sanctum');


Route::get('/countMonthBills',[MonthBillsController::class,'countMonthBills'])->middleware('auth:sanctum');

  // *****************************************************************
  //doctors

  Route::get('/allPosts',[PostController::class,'allPosts'])->middleware('auth:sanctum');
  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->middleware('auth:sanctum');
  Route::get('/myPosts',[PostController::class,'myPosts'])->middleware('auth:sanctum');
  Route::post('/storePost',[PostController::class,'storePost'])->middleware('auth:sanctum');
  Route::post('/update/{id}',[PostController::class,'update'])->middleware('auth:sanctum');
  Route::delete('/softDelete/post/{id}',[PostController::class,'softDelete'])->middleware('auth:sanctum');
  Route::post('/restore/post/{id}',[PostController::class,'restore'])->middleware('auth:sanctum');
  Route::get('/countMyPosts',[PostController::class,'countMyPosts'])->middleware('auth:sanctum');

 Route::post('/store/comment/{post_id}',[CommentController::class,'store'])->middleware('auth:sanctum');
  Route::post('/update/comment/{comment_id}',[CommentController::class,'update'])->middleware('auth:sanctum');
  Route::delete('/delete/comment/{id}',[CommentController::class,'delete'])->middleware('auth:sanctum');
  Route::get('/index/{post_id}',[CommentController::class,'index'])->middleware('auth:sanctum');
  Route::get('/countPostComments/{post_id}',[CommentController::class,'countPostComments'])->middleware('auth:sanctum');//test


  Route::get('/myProfile',[DoctorInformationController::class,'myProfile'])->middleware('auth:sanctum');
  Route::post('/updateProfile',[DoctorInformationController::class,'updateProfile'])->middleware('auth:sanctum');
  Route::post('/store/info',[DoctorInformationController::class,'store'])->middleware('auth:sanctum');








