<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobsController;



Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/account/register',[AccountController::class,'registration'])
->name('account.registration');

Route::post('/account/process_register',[AccountController::class,'process_registration'])
->name('account.processRegister');

Route::post('/account/deleteJob',[AccountController::class,'deleteJob'])
->name('account.deleteJob');

Route::get('/account/login',[AccountController::class,'login'])
->name('account.login')->middleware('guest');

Route::post('/account/authenticate',[AccountController::class,'authenticate'])
->name('account.authenticate');

Route::get('/account/profile',[AccountController::class,'profile'])
->name('account.profile')->middleware('auth');

Route::get('/account/logout',[AccountController::class,'logout'])
->name('account.logout');

Route::post('/account/update',[AccountController::class,'update'])
->name('account.update');

Route::post('/account/updateProfilePic',[AccountController::class,'updateProfilePic'])
->name('account.updateProfilePic');

Route::get('/account/PostJob',[AccountController::class,'PostJob'])
->name('account.PostJob')->middleware('auth');;

Route::post('/account/SaveJob',[AccountController::class,'saveJob'])
->name('account.SaveJob');

Route::get('/account/MyJobs',[AccountController::class,'myJobs'])
->name('account.MyJobs');

Route::get('/account/editJob/{id}',[AccountController::class,'editJob'])
->name('account.editJob');

Route::get('/jobs',[JobsController::class,'index'])
->name('account.jobs');

Route::get('/jobs/detail/{id?}',[JobsController::class,'detail'])
->name('jobDetail');

Route::get('/apply-job',[JobsController::class,'applyJob'])
->name('applyJob');

Route::get('/myJobApplications',[JobsController::class,'myJobApplications'])
->name('myJobApplications');

Route::post('/remove-job-application',[JobsController::class,'removeJobs'])
->name('account.removeJobs');  

Route::get('/category/{id?}',[JobsController::class,'category_wise'])
->name('account.category_wise');  

Route::get('/account/savedJobs',[JobsController::class,'savedJobs'])
->name('account.savedJobs'); 

Route::post('/account/saveTheJob',[JobsController::class,'saveTheJob'])
->name('account.saveTheJob'); 



Route::post('/account/delSavedJob',[JobsController::class,'delSavedJob'])
->name('account.delSavedJob'); 