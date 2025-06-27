<?php

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\SuggestController;
use App\Http\Controllers\Api\PlanOrderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\MonthBillsController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BlockedUserController;
use App\Http\Controllers\Api\DoctorHolidayController;
use App\Http\Controllers\Api\DescriptionPlanController;
use App\Http\Controllers\Api\DoctorInformationController;
use App\Http\Controllers\Api\PatientInformationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('firstPage');
})->name('firstPage');

Auth::routes();




//admins


Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDash'])->name('admin.dashboard'); // وجهة الأدمن


    Route::get('/admin/myProfile',[DoctorInformationController::class,'adminProfile'])->name('admin.myProfile')->middleware('auth');

    Route::get('/admin/plans/count', [PlanOrderController::class, 'countPlans']);


    Route::get('/getDoctors',[UserController::class,'getDoctors'])->name('getDoctors');//


Route::get('/getAllDoctors',[UserController::class,'getAllDoctors'])->name('getAllDoctors');
Route::get('/getDoctor/{id}',[UserController::class,'getDoctor'])->name('getDoctor');
Route::get('/getDoctorWithPatients/{id}',[UserController::class,'getDoctorWithPatients'])->name('getDoctorWithPatients');
Route::post('/softDelete/{id}',[UserController::class,'softDelete'])->name('user.softDelete');//doctor
Route::get('/deletedUsers',[UserController::class,'deletedUsers'])->name('deletedUsers');
Route::post('/restore/{id}',[UserController::class,'restore'])->name('user.restore');

Route::get('/getAllPatient',[UserController::class,'getAllPatient'])->name('getAllPatient');

Route::post('/isAgreeDoctor/{id}',[UserController::class,'isAgreeDoctor'])->name('isAgreeDoctor');
Route::get('/allPendingDoctors',[UserController::class,'allPendingDoctors'])->name('allPendingDoctors');
Route::get('/countUser',[UserController::class,'countUser'])->name('countUser');

Route::get('/getAllPlanOrders',[PlanOrderController::class,'getAllPlanOrders'])->name('getAllPlanOrders');
Route::get('/showPlanOrder/{id}',[PlanOrderController::class,'showPlanOrder'])->name('showPlanOrder');

Route::get('/countPlans',[PlanOrderController::class,'countPlans'])->name('countPlans');


Route::get('/getDeletedPosts',[PostController::class,'getDeletedPosts'])->name('getDeletedPosts');
Route::get('/admin/allPosts',[PostController::class,'allPosts'])->name('allPosts');


Route::get('/getBlockedUsers',[BlockedUserController::class,'getBlockedUsers'])->name('getBlockedUsers');

Route::post('/blockUser/{id}',[BlockedUserController::class,'blockUser'])->name('blockUser');
Route::post('/disblockUser/{id}',[BlockedUserController::class,'disblockUser'])->name('disblockUser');

Route::get('/countBlockUser',[BlockedUserController::class,'countBlockUser'])->name('countBlockUser');

Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->name('patientBills');
Route::get('/monthBills',[BillController::class,'monthBills'])->name('monthBills');


Route::get('/allreportsOfDoctor/{id}',[ReportController::class,'allreportsOfDoctor'])->name('allreportsOfDoctor');
Route::get('/getAllreports',[ReportController::class,'getAllreports'])->name('getAllreports');


Route::get('/countMonthBills',[MonthBillsController::class,'countMonthBills'])->name('countMonthBills');


Route::delete('/deleteIngredient/{id}',[IngredientController::class,'deleteIngredient'])->name('deleteIngredient');
Route::post('/storeIngredient',[IngredientController::class,'storeIngredient'])->name('storeIngredient');
Route::post('/updateingredient/{id}',[IngredientController::class,'updateingredient'])->name('updateingredient');
Route::get('/index/ingre',[IngredientController::class,'index'])->name('ingredient.index');

Route::post('/storeFood',[FoodController::class,'storeFood'])->name('storeFood');
Route::delete('/deleteFood/{id}',[FoodController::class,'deleteFood'])->name('deleteFood');
Route::post('/updateFood/{id}',[FoodController::class,'updateFood'])->name('updateFood');
Route::get('/index/food',[FoodController::class,'index'])->name('food.index');


Route::get('/getPlansReviews',[ReviewController::class,'getPlansReviews'])->name('getPlansReviews');

});

  // *****************************************************************

  //doctors

//   Route::post('/login',[AuthController::class,'login']);//تنشيط الحساب  doctor+ patient+admin
// Route::post('/login',[HomeController::class,'authenticated'])->name('signIn')->middleware('auth');

    Route::get('/doctor/dashboard', [HomeController::class, 'doctorDash'])->name('doctor.dashboard')->middleware(['auth']); // وجهة الطبيب

    Route::get('/myProfile',[DoctorInformationController::class,'myProfile'])->name('doctor.myProfile')->middleware('auth');
    Route::get('/editProfile/{id}',[DoctorInformationController::class,'editProfile'])->name('editProfile');
    Route::post('/profile/update', [DoctorInformationController::class, 'updateProfile'])->name('updateProfile');



    Route::middleware(['auth','isAgreeDoctor'])->group(function(){

    Route::post('/storePlan/{plan_order_id}',[PlanController::class,'storePlan'])->name('storePlan');
    Route::post('/updatePlan/{plan_order_id}/{plan_id}',[PlanController::class,'updatePlan'])->name('updatePlan');
    Route::delete('/deletePlan/{id}',[PlanController::class,'deletePlan'])->name('deletePlan');
    Route::get('/showPlan/{plan_order_id}',[PlanController::class,'showPlan'])->name('showPlan');
    Route::get('/addPlan/{plan_order_id}',[PlanController::class,'addPlan'])->name('addPlan');
    Route::get('/editPlan/{plan_order_id}',[PlanController::class,'editPlan'])->name('editPlan');



  Route::delete('/softDeleteMe',[UserController::class,'softDeleteMe'])->name('softDeleteMe');//الغاء تنشيط الحساب

  Route::get('/editPost/{id}',[PostController::class,'editPost'])->name('editPost');
  Route::get('/addPost',[PostController::class,'addPost'])->name('addPost');

  Route::get('/allPosts',[PostController::class,'allPosts'])->name('allPosts');
  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->name('doctorPosts');
  Route::get('/myPosts',[PostController::class,'myPosts'])->name('myPosts');
  Route::post('/storePost',[PostController::class,'storePost'])->middleware(['BlockUser'])->name('storePost');//if was not blocked
  Route::post('/update/{id}',[PostController::class,'update'])->name('post.update');
  Route::delete('/softDelete/post/{id}',[PostController::class,'softDelete'])->name('post.softDelete');
  Route::post('/restore/post/{id}',[PostController::class,'restore'])->name('post.restore');
  Route::get('/countMyPosts',[PostController::class,'countMyPosts'])->name('countMyPosts');
  Route::get('/myDeletedPosts',[PostController::class,'myDeletedPosts'])->name('myDeletedPosts');



  Route::post('/updateProfile',[DoctorInformationController::class,'updateProfile'])->name('doctor.updateProfile');
  Route::post('/store/info',[DoctorInformationController::class,'store'])->name('doctor.store');



  Route::get('/myPatients',[UserController::class,'myPatients'])->name('myPatients');
  Route::get('/getPatientWithInfo/{id}',[UserController::class,'getPatientWithInfo'])->name('getPatientWithInfo');

  Route::get('/getfollows',[FollowController::class,'getfollows'])->name('getfollows');
  Route::get('/countfollows',[FollowController::class,'countfollows'])->name('countfollows');


  Route::get('/countlikes/{post_id}',[LikeController::class,'countlikes'])->name('countlikes');
  Route::get('/getlikes/{post_id}',[LikeController::class,'getlikes'])->name('getlikes');


  Route::get('/getPlanOrders',[PlanOrderController::class,'getPlanOrders'])->name('getPlanOrders');
  Route::get('/countPlanOrders',[PlanOrderController::class,'countPlanOrders'])->name('countPlanOrders');
  Route::post('/addPrice',[PlanOrderController::class,'addPrice'])->name('addPrice');


  Route::get('/getSuggests/{plan_id}',[SuggestController::class,'getSuggests'])->name('getSuggests');


  Route::post('/updateNote/{patient_id}/{id}',[NotesController::class,'updateNote'])->name('updateNote');
  Route::post('/storeNotes/{patient_id}',[NotesController::class,'storeNote'])->name('storeNote');
  Route::delete('/deleteNote/{id}',[NotesController::class,'deleteNote'])->name('deleteNote');
  Route::get('/allNotesOfPatient/{id}',[NotesController::class,'allNotesOfPatient'])->name('allNotesOfPatient');



  Route::get('/patientBills/{id}',[BillController::class,'patientBills'])->name('patientBills');


  Route::get('/showMyBills',[MonthBillsController::class,'showMyBills'])->name('showMyBills');
  Route::get('/countMyBills',[MonthBillsController::class,'countMyBills'])->name('countMyBills');
  Route::get('/countPaidBills',[MonthBillsController::class,'countPaidBills'])->name('countPaidBills');
  Route::get('/unPaidBills',[MonthBillsController::class,'unPaidBills'])->name('unPaidBills');
  Route::post('/paidBill/{id}',[MonthBillsController::class,'paidBill'])->name('paidBill');


  Route::get('/addReport',[ReportController::class,'addReport'])->name('addReport');
  Route::get('/editReport/{report_id}',[ReportController::class,'editReport'])->name('editReport');

  Route::post('/storeReport',[ReportController::class,'storeReport'])->name('storeReport');

  Route::post('/updateReport/{id}/{patient_id}',[ReportController::class,'updateReport'])->name('updateReport');
  Route::delete('/deleteReport/{id}',[ReportController::class,'deleteReport'])->name('deleteReport');
  Route::get('/patientReports/{id}',[ReportController::class,'patientReports'])->name('patientReports');

  Route::get('/getReports',[ReportController::class,'getReports'])->name('getReports');



  Route::get('/planBills',[BillController::class,'planBills'])->name('planBills');




  Route::post('/storeDescriptionPlan/{plan_id}',[DescriptionPlanController::class,'storeDescriptionPlan'])->name('storeDescriptionPlan');

  Route::post('/updateDescriptionPlan/{plan_id}/{id}',[DescriptionPlanController::class,'updateDescriptionPlan'])->name('updateDescriptionPlan');
  Route::delete('/deleteDescriptionPlan/{id}',[DescriptionPlanController::class,'deleteDescriptionPlan'])->name('deleteDescriptionPlan');



  Route::post('/addPatientReview/{patient_id}',[ReviewController::class,'addPatientReview'])->name('addPatientReview');
  Route::get('/getPlanReview/{id}',[ReviewController::class,'getPlanReview'])->name('getPlanReview');
  Route::get('/getPatientReview/{id}',[ReviewController::class,'getPatientReview'])->name('getPatientReview');//+admin
  Route::get('/myReviewForMyPatients',[ReviewController::class,'myReviewForMyPatients'])->name('myReviewForMyPatients');


  Route::get('/holiday/index',[DoctorHolidayController::class,'index'])->name('holiday.index');
  Route::get('/doctorHolidays/{doc_id}',[DoctorHolidayController::class,'doctorHolidays'])->name('doctorHolidays');
  Route::get('/myHolidays',[DoctorHolidayController::class,'myHolidays'])->name('myHolidays');
  Route::post('/storeHoliday',[DoctorHolidayController::class,'storeHoliday'])->name('storeHoliday');
  Route::post('/updateHoliday/{id}',[DoctorHolidayController::class,'updateHoliday'])->name('updateHoliday');
  Route::delete('/deleteHoliday/{id}',[DoctorHolidayController::class,'deleteHoliday'])->name('deleteHoliday');



  Route::get('/getAppointments',[AppointmentController::class,'getAppointments'])->name('getAppointments');
  Route::put('/appointments/cancelStatus/{id}', [AppointmentController::class, 'cancelStatus'])->name('appointments.cancelStatus');
  Route::put('/appointments/doneStatus/{id}', [AppointmentController::class, 'doneStatus'])->name('appointments.doneStatus');


  });


//   *********************************************************************************

  //patient

  Route::get('/home', [HomeController::class, 'index'])->name('home');

  Route::middleware(['auth'])->group(function() {


    Route::get('/myReports',[ReportController::class,'myReports'])->name('myReports');

  Route::get('/show-posts',[PostController::class,'homePosts'])->name('homePosts');//


    Route::get('/getAllDoctors',[UserController::class,'getAllDoctors'])->name('getAllDoctors');//

    Route::get('/services',function () {
        return view('services');
    })->name('services');//


    Route::get('/desc/planOrder',function () {
        return view('planOrder.desc');
    })->name('descPlan');//

    Route::get('/contact',function () {
        return view('contact');
    })->name('contact');

  Route::post('/storeSuggest/{plan_id}',[SuggestController::class,'storeSuggest'])->name('storeSuggest');
  Route::post('/updateSuggest/{id}/{plan_id}',[SuggestController::class,'updateSuggest'])->name('updateSuggest');
  Route::delete('/deleteSuggest/{id}',[SuggestController::class,'deleteSuggest'])->name('deleteSuggest');



  Route::post('/addPlanReview/{plan_id}',[ReviewController::class,'addPlanReview'])->name('addPlanReview');
  Route::get('/getReview',[ReviewController::class,'getReview'])->name('getReview');



  Route::get('/doctorPosts/{doctor_id}',[PostController::class,'doctorPosts'])->name('doctorPosts');



  Route::get('/stripe',function(){
    return view('planOrder.stripe');
  })->name('stripe');


 Route::post('/store/comment/{post_id}',[CommentController::class,'store'])->middleware(['BlockUser'])->name('comment.store');//if was not blocked
 Route::post('/update/comment/{comment_id}',[CommentController::class,'update'])->name('comment.update');
 Route::delete('/delete/comment/{id}',[CommentController::class,'delete'])->name('comment.delete');
 Route::get('/index/{post_id}',[CommentController::class,'index'])->name('comment.index');
 Route::get('/countPostComments/{post_id}',[CommentController::class,'countPostComments'])->name('countPostComments');

 Route::post('/storePlanOrder',[PlanOrderController::class,'storePlanOrder'])->name('storePlanOrder');

 Route::post('/update-payment-status', [PaymentController::class, 'updateStatus'])->name('payment.updateStatus');


  Route::post('/paid/{planOrder_id}',[PlanOrderController::class,'paid'])->name('planOrder.paid');
  Route::get('/myOrdersPlans',[PlanOrderController::class,'myOrdersPlans'])->name('myOrdersPlans');
  Route::post('/updatePlanOrder/{id}',[PlanOrderController::class,'updatePlanOrder'])->name('updatePlanOrder');
  Route::get('/create/planOrder',[PlanOrderController::class,'createPlanOrder'])->name('createPlan');//




// في ملف routes/web.php
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('processPayment');
// Route::get('/stripe', [PaymentController::class, 'processPayment'])->name('stripe');





  Route::get('/getPlan/{plan_order_id}',[PlanController::class,'getPlan'])->name('getPlan');
  Route::get('/showPlan/{plan_order_id}',[PlanController::class,'showPlan'])->name('showPlan');


  Route::get('/myProfile/patient/{idd}',[PatientInformationController::class,'myProfile'])->name('patient.myProfile');
  Route::post('/updateProfile/patient',[PatientInformationController::class,'updateProfile'])->name('patient.updateProfile');
  Route::post('/store/patient/info',[PatientInformationController::class,'store'])->name('patient.store');


  Route::get('/myNotes',[NotesController::class,'myNotes'])->name('myNotes');


  Route::post('/createLike/{post_id}',[LikeController::class,'createLike'])->name('createLike');//
  Route::delete('/disLike/{post_id}',[LikeController::class,'disLike'])->name('disLike');//


  Route::post('/followDoctor/{doctor_id}',[FollowController::class,'followDoctor'])->name('followDoctor');//
  Route::post('/disfollowDoctor/{doctor_id}',[FollowController::class,'disfollowDoctor'])->name('disfollowDoctor');//
  Route::get('/myFollowers',[FollowController::class,'myFollowers'])->name('myFollowers');//


  Route::get('/doctorProfile/{id}',[DoctorInformationController::class,'doctorProfile'])->name('doctorProfile');////


  Route::get('/show/desc/{id}',[DescriptionPlanController::class,'show'])->name('planDescription.show');
  //show all desc-plan of this plan
  Route::get('/index/desc/{plan_id}',[DescriptionPlanController::class,'index'])->name('DescriptionPlan.index');
  Route::post('/isDone/{id}',[DescriptionPlanController::class,'isDone'])->name('DescriptionPlan.isDone');

  Route::get('/foodIngredient/{id}',[FoodController::class,'foodIngredient'])->name('foodIngredient');


  Route::get('/myBills',[BillController::class,'myBills'])->name('myBills');


  Route::post('/bookAppointment',[AppointmentController::class,'bookAppointment'])->name('bookAppointment');

  Route::get('/getAvailable', [AppointmentController::class, 'getAvailable'])->name('getAvailable');

  Route::get('/myAppointments',[AppointmentController::class,'myAppointments'])->name('myAppointments');

  Route::get('/appointments',function(){

$appointments=Appointment::where('patient_id',auth()->user()->id)->get();
$doctors=User::where('role','doctor')->where('isAgreeDoctorRegistration','agree')->get();
    return view('patient.appointment',['appointments'=>$appointments,'doctors'=>$doctors]);
})->name('appointments');


Route::get('/appointments-available',function(){
    return view('appointments.available');})->name('appointment.available');


//   Route::get('/export/{planId}',[PlanController::class,'export'])->name('export');
//

  });
