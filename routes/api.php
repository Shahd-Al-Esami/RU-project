<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotesController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\SuggestController;
use App\Http\Controllers\Api\PlanOrderController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\MonthBillsController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BlockedUserController;
use App\Http\Controllers\Api\DoctorHolidayController;
use App\Http\Controllers\Api\DescriptionPlanController;
use App\Http\Controllers\Api\DoctorInformationController;
use App\Http\Controllers\Api\PatientInformationController;

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
Route::delete('/softDelete/{id}',[UserController::class,'softDelete'])->middleware('auth:sanctum');//doctor
Route::get('/deletedUsers',[UserController::class,'deletedUsers'])->middleware('auth:sanctum');
Route::post('/restore/{id}',[UserController::class,'restore'])->middleware('auth:sanctum');
Route::get('/getAllPatient',[UserController::class,'getAllPatient'])->middleware('auth:sanctum');
Route::post('/isAgreeDoctor/{id}',[UserController::class,'isAgreeDoctor'])->middleware('auth:sanctum');
Route::get('/allPendingDoctors',[UserController::class,'allPendingDoctors'])->middleware('auth:sanctum');
Route::get('/countUser',[UserController::class,'countUser'])->middleware('auth:sanctum');

Route::get('/getAllPlanOrders',[PlanOrderController::class,'getAllPlanOrders'])->middleware('auth:sanctum');
Route::get('/showPlanOrder/{id}',[PlanOrderController::class,'showPlanOrder'])->middleware('auth:sanctum');
Route::get('/countPlans',[PlanOrderController::class,'countPlans'])->middleware('auth:sanctum');


Route::get('/getDeletedPosts',[PostController::class,'getDeletedPosts'])->middleware('auth:sanctum');


Route::get('/getBlockedUsers',[BlockedUserController::class,'getBlockedUsers'])->middleware('auth:sanctum');
Route::post('/blockUser/{id}',[BlockedUserController::class,'blockUser'])->middleware('auth:sanctum');
Route::post('/disblockUser/{id}',[BlockedUserController::class,'disblockUser'])->middleware('auth:sanctum');
Route::get('/countBlockUser',[BlockedUserController::class,'countBlockUser'])->middleware('auth:sanctum');

Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->middleware('auth:sanctum');
Route::get('/monthBills',[BillController::class,'monthBills'])->middleware('auth:sanctum');


Route::get('/allreportsOfDoctor/{id}',[ReportController::class,'allreportsOfDoctor'])->middleware('auth:sanctum');
Route::get('/getAllreports',[ReportController::class,'getAllreports'])->middleware('auth:sanctum');


Route::get('/countMonthBills',[MonthBillsController::class,'countMonthBills'])->middleware('auth:sanctum');


Route::delete('/deleteIngredient/{id}',[IngredientController::class,'deleteIngredient'])->middleware('auth:sanctum');
Route::post('/storeIngredient',[IngredientController::class,'storeIngredient'])->middleware('auth:sanctum');
Route::post('/updateingredient/{id}',[IngredientController::class,'updateingredient'])->middleware('auth:sanctum');
Route::get('/index/ingre',[IngredientController::class,'index'])->middleware('auth:sanctum');

Route::post('/storeFood',[FoodController::class,'storeFood'])->middleware('auth:sanctum');
Route::delete('/deleteFood/{id}',[FoodController::class,'deleteFood'])->middleware('auth:sanctum');
Route::post('/updateFood/{id}',[FoodController::class,'updateFood'])->middleware('auth:sanctum');
Route::get('/index/food',[FoodController::class,'index'])->middleware('auth:sanctum');


Route::get('/getPlansReviews',[ReviewController::class,'getPlansReviews'])->middleware('auth:sanctum');



  // *****************************************************************
  //doctors


  Route::post('/login',[AuthController::class,'login']);//تنشيط الحساب

  Route::middleware(['auth:sanctum','isAgreeDoctor'])->group(function(){

    Route::post('/storePlan/{plan_order_id}',[PlanController::class,'storePlan'])->middleware('auth:sanctum');
    Route::post('/updatePlan/{plan_order_id}/{plan_id}',[PlanController::class,'updatePlan'])->middleware('auth:sanctum');
    Route::delete('/deletePlan/{id}',[PlanController::class,'deletePlan'])->middleware('auth:sanctum');



  Route::delete('/softDeleteMe',[UserController::class,'softDeleteMe'])->middleware('auth:sanctum');//الغاء تنشيط الحساب


  Route::get('/allPosts',[PostController::class,'allPosts']);
  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->middleware('auth:sanctum');
  Route::get('/myPosts',[PostController::class,'myPosts'])->middleware('auth:sanctum');
  Route::post('/storePost',[PostController::class,'storePost'])->middleware(['BlockUser','auth:sanctum']);//if was not blocked
  Route::post('/update/{id}',[PostController::class,'update'])->middleware('auth:sanctum');
  Route::delete('/softDelete/post/{id}',[PostController::class,'softDelete'])->middleware('auth:sanctum');
  Route::post('/restore/post/{id}',[PostController::class,'restore'])->middleware('auth:sanctum');
  Route::get('/countMyPosts',[PostController::class,'countMyPosts'])->middleware('auth:sanctum');
  Route::get('/myDeletedPosts',[PostController::class,'myDeletedPosts'])->middleware('auth:sanctum');



  Route::get('/myProfile',[DoctorInformationController::class,'myProfile'])->middleware('auth:sanctum');
  Route::post('/updateProfile',[DoctorInformationController::class,'updateProfile'])->middleware('auth:sanctum');
  Route::post('/store/info',[DoctorInformationController::class,'store'])->middleware('auth:sanctum');



  Route::get('/myPatients',[UserController::class,'myPatients'])->middleware('auth:sanctum');
  Route::get('/getPatientWithInfo/{id}',[UserController::class,'getPatientWithInfo'])->middleware('auth:sanctum');

  Route::get('/getfollows',[FollowController::class,'getfollows'])->middleware('auth:sanctum');
  Route::get('/countfollows',[FollowController::class,'countfollows'])->middleware('auth:sanctum');


  Route::get('/countlikes/{post_id}',[LikeController::class,'countlikes'])->middleware('auth:sanctum');
  Route::get('/getlikes/{post_id}',[LikeController::class,'getlikes'])->middleware('auth:sanctum');


  Route::get('/getPlanOrders',[PlanOrderController::class,'getPlanOrders'])->middleware('auth:sanctum');
  Route::get('/countPlanOrders',[PlanOrderController::class,'countPlanOrders'])->middleware('auth:sanctum');
  Route::post('/addPrice/{planOrder_id}',[PlanOrderController::class,'addPrice'])->middleware('auth:sanctum');


  Route::get('/getSuggests/{plan_id}',[SuggestController::class,'getSuggests'])->middleware('auth:sanctum');


  Route::post('/updateNote/{patient_id}/{id}',[NotesController::class,'updateNote'])->middleware('auth:sanctum');
  Route::post('/storeNotes/{patient_id}',[NotesController::class,'storeNote'])->middleware('auth:sanctum');
  Route::delete('/deleteNote/{id}',[NotesController::class,'deleteNote'])->middleware('auth:sanctum');
  Route::get('/allNotesOfPatient/{id}',[NotesController::class,'allNotesOfPatient'])->middleware('auth:sanctum');



  Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->middleware('auth:sanctum');


  Route::get('/showMyBills',[MonthBillsController::class,'showMyBills'])->middleware('auth:sanctum');
  Route::get('/countMyBills',[MonthBillsController::class,'countMyBills'])->middleware('auth:sanctum');
  Route::get('/countPaidBills',[MonthBillsController::class,'countPaidBills'])->middleware('auth:sanctum');
  Route::get('/unPaidBills',[MonthBillsController::class,'unPaidBills'])->middleware('auth:sanctum');
  Route::post('/paidBill/{id}',[MonthBillsController::class,'paidBill'])->middleware('auth:sanctum');


  Route::post('/storeReport/{patient_id}/{plan_id}',[ReportController::class,'storeReport'])->middleware('auth:sanctum');
  Route::post('/updateReport/{id}/{plan_id}/{patient_id}',[ReportController::class,'updateReport'])->middleware('auth:sanctum');
  Route::delete('/deleteReport/{id}',[ReportController::class,'deleteReport'])->middleware('auth:sanctum');
  Route::get('/myReports',[ReportController::class,'myReports'])->middleware('auth:sanctum');
  Route::get('/patientReports/{id}',[ReportController::class,'patientReports'])->middleware('auth:sanctum');


  Route::post('/storeDescriptionPlan/{plan_id}',[DescriptionPlanController::class,'storeDescriptionPlan'])->middleware('auth:sanctum');
  Route::post('/updateDescriptionPlan/{plan_id}/{id}',[DescriptionPlanController::class,'updateDescriptionPlan'])->middleware('auth:sanctum');
  Route::delete('/deleteDescriptionPlan/{id}',[DescriptionPlanController::class,'deleteDescriptionPlan'])->middleware('auth:sanctum');



  Route::post('/addPatientReview/{patient_id}',[ReviewController::class,'addPatientReview'])->middleware('auth:sanctum');
  Route::get('/getPlanReview/{id}',[ReviewController::class,'getPlanReview'])->middleware('auth:sanctum');
  Route::get('/getPatientReview/{id}',[ReviewController::class,'getPatientReview'])->middleware('auth:sanctum');//+admin
  Route::get('/myReviewForMyPatients',[ReviewController::class,'myReviewForMyPatients'])->middleware('auth:sanctum');


  Route::get('/holiday/index',[DoctorHolidayController::class,'index'])->middleware('auth:sanctum');
  Route::get('/doctorHolidays/{doc_id}',[DoctorHolidayController::class,'doctorHolidays'])->middleware('auth:sanctum');
  Route::get('/myHolidays',[DoctorHolidayController::class,'myHolidays'])->middleware('auth:sanctum');
  Route::post('/storeHoliday',[DoctorHolidayController::class,'storeHoliday'])->middleware('auth:sanctum');
  Route::post('/updateHoliday/{id}',[DoctorHolidayController::class,'updateHoliday'])->middleware('auth:sanctum');
  Route::delete('/deleteHoliday/{id}',[DoctorHolidayController::class,'deleteHoliday'])->middleware('auth:sanctum');



  Route::get('/getAppointments',[AppointmentController::class,'getAppointments'])->middleware('auth:sanctum');

  });


//   *********************************************************************************

  //patient

  Route::post('/storeSuggest/{plan_id}',[SuggestController::class,'storeSuggest'])->middleware('auth:sanctum');
  Route::post('/updateSuggest/{id}/{plan_id}',[SuggestController::class,'updateSuggest'])->middleware('auth:sanctum');
  Route::delete('/deleteSuggest/{id}',[SuggestController::class,'deleteSuggest'])->middleware('auth:sanctum');



  Route::post('/addPlanReview/{plan_id}',[ReviewController::class,'addPlanReview'])->middleware('auth:sanctum');
  Route::get('/getReview',[ReviewController::class,'getReview'])->middleware('auth:sanctum');



  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts']);
  Route::get('/homePosts',[PostController::class,'homePosts'])->middleware('auth:sanctum');




 Route::post('/store/comment/{post_id}',[CommentController::class,'store'])->middleware(['BlockUser','auth:sanctum']);//if was not blocked
 Route::post('/update/comment/{comment_id}',[CommentController::class,'update'])->middleware('auth::sanctum');
 Route::delete('/delete/comment/{id}',[CommentController::class,'delete'])->middleware('auth::sanctum');
 Route::get('/index/{post_id}',[CommentController::class,'index']);
 Route::get('/countPostComments/{post_id}',[CommentController::class,'countPostComments']);

  Route::post('/paid/{planOrder_id}',[PlanOrderController::class,'paid'])->middleware('auth:sanctum');
  Route::post('/storePlanOrder',[PlanOrderController::class,'storePlanOrder'])->middleware('auth:sanctum');
  Route::get('/myOrdersPlans',[PlanOrderController::class,'myOrdersPlans'])->middleware('auth:sanctum');
  Route::post('/updatePlanOrder/{id}',[PlanOrderController::class,'updatePlanOrder'])->middleware('auth:sanctum');


  Route::get('/getPlan/{plan_order_id}',[PlanController::class,'getPlan'])->middleware('auth:sanctum');
  Route::get('/showPlan/{plan_order_id}',[PlanController::class,'showPlan'])->middleware('auth:sanctum');


  Route::get('/myProfile/patient',[PatientInformationController::class,'myProfile'])->middleware('auth:sanctum');
  Route::post('/updateProfile/patient',[PatientInformationController::class,'updateProfile'])->middleware('auth:sanctum');
  Route::post('/store/patient/info',[PatientInformationController::class,'store'])->middleware('auth:sanctum');


  Route::get('/myNotes',[NotesController::class,'myNotes'])->middleware('auth:sanctum');


  Route::post('/createLike/{post_id}',[LikeController::class,'createLike'])->middleware('auth:sanctum');
  Route::delete('/disLike/{post_id}',[LikeController::class,'disLike'])->middleware('auth:sanctum');


  Route::post('/followDoctor/{doctor_id}',[FollowController::class,'followDoctor'])->middleware('auth:sanctum');
  Route::post('/disfollowDoctor/{doctor_id}',[FollowController::class,'disfollowDoctor'])->middleware('auth:sanctum');
  Route::get('/myFollowers',[FollowController::class,'myFollowers'])->middleware('auth:sanctum');


  Route::get('/doctorProfile/{id}',[DoctorInformationController::class,'doctorProfile'])->middleware('auth:sanctum');


  Route::get('/show/desc/{id}',[DescriptionPlanController::class,'show'])->middleware('auth:sanctum');
  //show all desc-plan of this plan
  Route::get('/index/desc/{plan_id}',[DescriptionPlanController::class,'index'])->middleware('auth:sanctum');
  Route::post('/isDone/{id}',[DescriptionPlanController::class,'isDone'])->middleware('auth:sanctum');

  Route::get('/foodIngredient/{id}',[FoodController::class,'foodIngredient'])->middleware('auth:sanctum');


  Route::get('/myBills',[BillController::class,'myBills'])->middleware('auth:sanctum');


  Route::post('/bookAppointment',[AppointmentController::class,'bookAppointment'])->middleware('auth:sanctum');
  Route::get('/getAvailable/{doctor_id}/{day}/{date}',[AppointmentController::class,'getAvailable'])->middleware('auth:sanctum');
  Route::get('/myAppointments',[AppointmentController::class,'myAppointments'])->middleware('auth:sanctum');



  Route::get('/export/{planId}',[PlanController::class,'export'])->middleware('auth:sanctum');


