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
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth:sanctum');
//admins
Route::get('/getAllDoctors',[UserController::class,'getAllDoctors'])->middleware('auth:sanctum')->name('getAllDoctors');
Route::get('/getDoctor/{id}',[UserController::class,'getDoctor'])->middleware('auth:sanctum')->name('getDoctor');
Route::get('/getDoctorWithPatients/{id}',[UserController::class,'getDoctorWithPatients'])->middleware('auth:sanctum')->name('getDoctorWithPatients');
Route::delete('/softDelete/{id}',[UserController::class,'softDelete'])->middleware('auth:sanctum')->name('softDelete');//doctor
Route::get('/deletedUsers',[UserController::class,'deletedUsers'])->middleware('auth:sanctum')->name('deletedUsers');
Route::post('/restore/{id}',[UserController::class,'restore'])->middleware('auth:sanctum')->name('restore');
Route::get('/getAllPatient',[UserController::class,'getAllPatient'])->middleware('auth:sanctum')->name('getAllPatient');
Route::post('/isAgreeDoctor/{id}',[UserController::class,'isAgreeDoctor'])->middleware('auth:sanctum')->name('isAgreeDoctor');
Route::get('/allPendingDoctors',[UserController::class,'allPendingDoctors'])->middleware('auth:sanctum')->name('allPendingDoctors');
Route::get('/countUser',[UserController::class,'countUser'])->middleware('auth:sanctum')->name('countUser');

Route::get('/getAllPlanOrders',[PlanOrderController::class,'getAllPlanOrders'])->middleware('auth:sanctum')->name('getAllPlanOrders');
Route::get('/showPlanOrder/{id}',[PlanOrderController::class,'showPlanOrder'])->middleware('auth:sanctum')->name('showPlanOrder');
Route::get('/countPlans',[PlanOrderController::class,'countPlans'])->middleware('auth:sanctum')->name('countPlans');


Route::get('/getDeletedPosts',[PostController::class,'getDeletedPosts'])->middleware('auth:sanctum')->name('getDeletedPosts');


Route::get('/getBlockedUsers',[BlockedUserController::class,'getBlockedUsers'])->middleware('auth:sanctum')->name('getBlockedUsers');
Route::post('/blockUser/{id}',[BlockedUserController::class,'blockUser'])->middleware('auth:sanctum')->name('blockUser');
Route::post('/disblockUser/{id}',[BlockedUserController::class,'disblockUser'])->middleware('auth:sanctum')->name('disblockUser');
Route::get('/countBlockUser',[BlockedUserController::class,'countBlockUser'])->middleware('auth:sanctum')->name('countBlockUser');

Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->middleware('auth:sanctum')->name('patientBills');
Route::get('/monthBills',[BillController::class,'monthBills'])->middleware('auth:sanctum')->name('monthBills');


Route::get('/allreportsOfDoctor/{id}',[ReportController::class,'allreportsOfDoctor'])->middleware('auth:sanctum')->name('allreportsOfDoctor');
Route::get('/getAllreports',[ReportController::class,'getAllreports'])->middleware('auth:sanctum')->name('getAllreports');


Route::get('/countMonthBills',[MonthBillsController::class,'countMonthBills'])->middleware('auth:sanctum')->name('countMonthBills');


Route::delete('/deleteIngredient/{id}',[IngredientController::class,'deleteIngredient'])->middleware('auth:sanctum')->name('deleteIngredient');
Route::post('/storeIngredient',[IngredientController::class,'storeIngredient'])->middleware('auth:sanctum')->name('storeIngredient');
Route::post('/updateingredient/{id}',[IngredientController::class,'updateingredient'])->middleware('auth:sanctum')->name('updateingredient');
Route::get('/index/ingre',[IngredientController::class,'index'])->middleware('auth:sanctum')->name('ingredient.index');

Route::post('/storeFood',[FoodController::class,'storeFood'])->middleware('auth:sanctum')->name('storeFood');
Route::delete('/deleteFood/{id}',[FoodController::class,'deleteFood'])->middleware('auth:sanctum')->name('deleteFood');
Route::post('/updateFood/{id}',[FoodController::class,'updateFood'])->middleware('auth:sanctum')->name('updateFood');
Route::get('/index/food',[FoodController::class,'index'])->middleware('auth:sanctum')->name('food.index');


Route::get('/getPlansReviews',[ReviewController::class,'getPlansReviews'])->middleware('auth:sanctum')->name('getPlansReviews');



  // *****************************************************************
  //doctors


  Route::post('/login',[AuthController::class,'login']);//تنشيط الحساب

  Route::middleware(['auth:sanctum','isAgreeDoctor'])->group(function(){

    Route::post('/storePlan/{plan_order_id}',[PlanController::class,'storePlan'])->middleware('auth:sanctum')->name('storePlan');
    Route::post('/updatePlan/{plan_order_id}/{plan_id}',[PlanController::class,'updatePlan'])->middleware('auth:sanctum')->name('updatePlan');
    Route::delete('/deletePlan/{id}',[PlanController::class,'deletePlan'])->middleware('auth:sanctum')->name('deletePlan');



  Route::delete('/softDeleteMe',[UserController::class,'softDeleteMe'])->middleware('auth:sanctum')->name('softDeleteMe');//الغاء تنشيط الحساب


  Route::get('/allPosts',[PostController::class,'allPosts'])->name('allPosts');
  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->middleware('auth:sanctum')->name('doctorPosts');
  Route::get('/myPosts',[PostController::class,'myPosts'])->middleware('auth:sanctum')->name('myPosts');
  Route::post('/storePost',[PostController::class,'storePost'])->middleware(['BlockUser','auth:sanctum'])->name('storePost');//if was not blocked
  Route::post('/update/{id}',[PostController::class,'update'])->middleware('auth:sanctum')->name('plan.update');
  Route::delete('/softDelete/post/{id}',[PostController::class,'softDelete'])->middleware('auth:sanctum')->name('plan.softDelete');
  Route::post('/restore/post/{id}',[PostController::class,'restore'])->middleware('auth:sanctum')->name('plan.restore');
  Route::get('/countMyPosts',[PostController::class,'countMyPosts'])->middleware('auth:sanctum')->name('countMyPosts');
  Route::get('/myDeletedPosts',[PostController::class,'myDeletedPosts'])->middleware('auth:sanctum')->name('myDeletedPosts');



  Route::get('/myProfile',[DoctorInformationController::class,'myProfile'])->middleware('auth:sanctum')->name('doctor.myProfile');
  Route::post('/updateProfile',[DoctorInformationController::class,'updateProfile'])->middleware('auth:sanctum')->name('doctor.updateProfile');
  Route::post('/store/info',[DoctorInformationController::class,'store'])->middleware('auth:sanctum')->name('doctor.store');



  Route::get('/myPatients',[UserController::class,'myPatients'])->middleware('auth:sanctum')->name('myPatients');
  Route::get('/getPatientWithInfo/{id}',[UserController::class,'getPatientWithInfo'])->middleware('auth:sanctum')->name('getPatientWithInfo');

  Route::get('/getfollows',[FollowController::class,'getfollows'])->middleware('auth:sanctum')->name('getfollows');
  Route::get('/countfollows',[FollowController::class,'countfollows'])->middleware('auth:sanctum')->name('countfollows');


  Route::get('/countlikes/{post_id}',[LikeController::class,'countlikes'])->middleware('auth:sanctum')->name('countlikes');
  Route::get('/getlikes/{post_id}',[LikeController::class,'getlikes'])->middleware('auth:sanctum')->name('getlikes');


  Route::get('/getPlanOrders',[PlanOrderController::class,'getPlanOrders'])->middleware('auth:sanctum')->name('getPlanOrders');
  Route::get('/countPlanOrders',[PlanOrderController::class,'countPlanOrders'])->middleware('auth:sanctum')->name('countPlanOrders');
  Route::post('/addPrice/{planOrder_id}',[PlanOrderController::class,'addPrice'])->middleware('auth:sanctum')->name('addPrice');


  Route::get('/getSuggests/{plan_id}',[SuggestController::class,'getSuggests'])->middleware('auth:sanctum')->name('getSuggests');


  Route::post('/updateNote/{patient_id}/{id}',[NotesController::class,'updateNote'])->middleware('auth:sanctum')->name('updateNote');
  Route::post('/storeNotes/{patient_id}',[NotesController::class,'storeNote'])->middleware('auth:sanctum')->name('storeNote');
  Route::delete('/deleteNote/{id}',[NotesController::class,'deleteNote'])->middleware('auth:sanctum')->name('deleteNote');
  Route::get('/allNotesOfPatient/{id}',[NotesController::class,'allNotesOfPatient'])->middleware('auth:sanctum')->name('allNotesOfPatient');



  Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->middleware('auth:sanctum')->name('patientBills');


  Route::get('/showMyBills',[MonthBillsController::class,'showMyBills'])->middleware('auth:sanctum')->name('showMyBills');
  Route::get('/countMyBills',[MonthBillsController::class,'countMyBills'])->middleware('auth:sanctum')->name('countMyBills');
  Route::get('/countPaidBills',[MonthBillsController::class,'countPaidBills'])->middleware('auth:sanctum')->name('countPaidBills');
  Route::get('/unPaidBills',[MonthBillsController::class,'unPaidBills'])->middleware('auth:sanctum')->name('unPaidBills');
  Route::post('/paidBill/{id}',[MonthBillsController::class,'paidBill'])->middleware('auth:sanctum')->name('paidBill');


  Route::post('/storeReport/{patient_id}/{plan_id}',[ReportController::class,'storeReport'])->middleware('auth:sanctum')->name('storeReport');
  Route::post('/updateReport/{id}/{plan_id}/{patient_id}',[ReportController::class,'updateReport'])->middleware('auth:sanctum')->name('updateReport');
  Route::delete('/deleteReport/{id}',[ReportController::class,'deleteReport'])->middleware('auth:sanctum')->name('deleteReport');
  Route::get('/myReports',[ReportController::class,'myReports'])->middleware('auth:sanctum')->name('myReports');
  Route::get('/patientReports/{id}',[ReportController::class,'patientReports'])->middleware('auth:sanctum')->name('patientReports');


  Route::post('/storeDescriptionPlan/{plan_id}',[DescriptionPlanController::class,'storeDescriptionPlan'])->middleware('auth:sanctum')->name('storeDescriptionPlan');
  Route::post('/updateDescriptionPlan/{plan_id}/{id}',[DescriptionPlanController::class,'updateDescriptionPlan'])->middleware('auth:sanctum')->name('updateDescriptionPlan');
  Route::delete('/deleteDescriptionPlan/{id}',[DescriptionPlanController::class,'deleteDescriptionPlan'])->middleware('auth:sanctum')->name('deleteDescriptionPlan');



  Route::post('/addPatientReview/{patient_id}',[ReviewController::class,'addPatientReview'])->middleware('auth:sanctum')->name('addPatientReview');
  Route::get('/getPlanReview/{id}',[ReviewController::class,'getPlanReview'])->middleware('auth:sanctum')->name('getPlanReview');
  Route::get('/getPatientReview/{id}',[ReviewController::class,'getPatientReview'])->middleware('auth:sanctum')->name('getPatientReview');//+admin
  Route::get('/myReviewForMyPatients',[ReviewController::class,'myReviewForMyPatients'])->middleware('auth:sanctum')->name('myReviewForMyPatients');


  Route::get('/holiday/index',[DoctorHolidayController::class,'index'])->middleware('auth:sanctum')->name('holiday.index');
  Route::get('/doctorHolidays/{doc_id}',[DoctorHolidayController::class,'doctorHolidays'])->middleware('auth:sanctum')->name('doctorHolidays');
  Route::get('/myHolidays',[DoctorHolidayController::class,'myHolidays'])->middleware('auth:sanctum')->name('myHolidays');
  Route::post('/storeHoliday',[DoctorHolidayController::class,'storeHoliday'])->middleware('auth:sanctum')->name('storeHoliday');
  Route::post('/updateHoliday/{id}',[DoctorHolidayController::class,'updateHoliday'])->middleware('auth:sanctum')->name('updateHoliday');
  Route::delete('/deleteHoliday/{id}',[DoctorHolidayController::class,'deleteHoliday'])->middleware('auth:sanctum')->name('deleteHoliday');



  Route::get('/getAppointments',[AppointmentController::class,'getAppointments'])->middleware('auth:sanctum')->name('getAppointments');

  });


//   *********************************************************************************

  //patient

  Route::post('/storeSuggest/{plan_id}',[SuggestController::class,'storeSuggest'])->middleware('auth:sanctum')->name('storeSuggest');
  Route::post('/updateSuggest/{id}/{plan_id}',[SuggestController::class,'updateSuggest'])->middleware('auth:sanctum')->name('updateSuggest');
  Route::delete('/deleteSuggest/{id}',[SuggestController::class,'deleteSuggest'])->middleware('auth:sanctum')->name('deleteSuggest');



  Route::post('/addPlanReview/{plan_id}',[ReviewController::class,'addPlanReview'])->middleware('auth:sanctum')->name('addPlanReview');
  Route::get('/getReview',[ReviewController::class,'getReview'])->middleware('auth:sanctum')->name('getReview');



  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->name('doctorPosts');
  Route::get('/homePosts',[PostController::class,'homePosts'])->middleware('auth:sanctum')->name('homePosts');




 Route::post('/store/comment/{post_id}',[CommentController::class,'store'])->middleware(['BlockUser','auth:sanctum'])->name('comment.store');//if was not blocked
 Route::post('/update/comment/{comment_id}',[CommentController::class,'update'])->middleware('auth::sanctum')->name('comment.update');
 Route::delete('/delete/comment/{id}',[CommentController::class,'delete'])->middleware('auth::sanctum')->name('comment.delete');
 Route::get('/index/{post_id}',[CommentController::class,'index'])->name('comment.index');
 Route::get('/countPostComments/{post_id}',[CommentController::class,'countPostComments'])->name('countPostComments');

  Route::post('/paid/{planOrder_id}',[PlanOrderController::class,'paid'])->middleware('auth:sanctum')->name('planOrder.paid');
  Route::post('/storePlanOrder',[PlanOrderController::class,'storePlanOrder'])->middleware('auth:sanctum')->name('storePlanOrder');
  Route::get('/myOrdersPlans',[PlanOrderController::class,'myOrdersPlans'])->middleware('auth:sanctum')->name('myOrdersPlans');
  Route::post('/updatePlanOrder/{id}',[PlanOrderController::class,'updatePlanOrder'])->middleware('auth:sanctum')->name('updatePlanOrder');


  Route::get('/getPlan/{plan_order_id}',[PlanController::class,'getPlan'])->middleware('auth:sanctum')->name('getPlan');
  Route::get('/showPlan/{plan_order_id}',[PlanController::class,'showPlan'])->middleware('auth:sanctum')->name('showPlan');


  Route::get('/myProfile/patient',[PatientInformationController::class,'myProfile'])->middleware('auth:sanctum')->name('patient.myProfile');
  Route::post('/updateProfile/patient',[PatientInformationController::class,'updateProfile'])->middleware('auth:sanctum')->name('patient.updateProfile');
  Route::post('/store/patient/info',[PatientInformationController::class,'store'])->middleware('auth:sanctum')->name('patient.store');


  Route::get('/myNotes',[NotesController::class,'myNotes'])->middleware('auth:sanctum')->name('myNotes');


  Route::post('/createLike/{post_id}',[LikeController::class,'createLike'])->middleware('auth:sanctum')->name('createLike');
  Route::delete('/disLike/{post_id}',[LikeController::class,'disLike'])->middleware('auth:sanctum')->name('disLike');


  Route::post('/followDoctor/{doctor_id}',[FollowController::class,'followDoctor'])->middleware('auth:sanctum')->name('followDoctor');
  Route::post('/disfollowDoctor/{doctor_id}',[FollowController::class,'disfollowDoctor'])->middleware('auth:sanctum')->name('disfollowDoctor');
  Route::get('/myFollowers',[FollowController::class,'myFollowers'])->middleware('auth:sanctum')->name('myFollowers');


  Route::get('/doctorProfile/{id}',[DoctorInformationController::class,'doctorProfile'])->middleware('auth:sanctum')->name('doctorProfile');


  Route::get('/show/desc/{id}',[DescriptionPlanController::class,'show'])->middleware('auth:sanctum')->name('storeSuggest');
  //show all desc-plan of this plan
  Route::get('/index/desc/{plan_id}',[DescriptionPlanController::class,'index'])->middleware('auth:sanctum')->name('DescriptionPlan,index');
  Route::post('/isDone/{id}',[DescriptionPlanController::class,'isDone'])->middleware('auth:sanctum')->name('DescriptionPlan.isDone');

  Route::get('/foodIngredient/{id}',[FoodController::class,'foodIngredient'])->middleware('auth:sanctum')->name('foodIngredient');


  Route::get('/myBills',[BillController::class,'myBills'])->middleware('auth:sanctum')->name('myBills');


  Route::post('/bookAppointment',[AppointmentController::class,'bookAppointment'])->middleware('auth:sanctum')->name('bookAppointment');
  Route::get('/getAvailable/{doctor_id}/{day}/{date}',[AppointmentController::class,'getAvailable'])->middleware('auth:sanctum')->name('getAvailable');
  Route::get('/myAppointments',[AppointmentController::class,'myAppointments'])->middleware('auth:sanctum')->name('myAppointments');



//   Route::get('/export/{planId}',[PlanController::class,'export'])->middleware('auth:sanctum');


