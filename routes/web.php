<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contactController;
use App\Http\Controllers\web\Catcontroller;
use App\Http\Controllers\web\Examcontroller;
use App\Http\Controllers\web\langController;
use App\Http\Controllers\web\HomeController ;
use App\Http\Controllers\web\Skillcontroller;
use App\Http\Controllers\admin\testController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\web\profileController;
use App\Http\Controllers\admin\MessegController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware('lang')->group(function(){
    
    Route::get('/',[HomeController::class,'index']);
    Route::get('cats/show/{id}',[Catcontroller::class,'show']);
    Route::get('skills/show/{id}',[Skillcontroller::class,'show']);
    Route::get('exams/show/{id}',[Examcontroller::class,'show']);
    Route::get('exams/questions/{id}',[Examcontroller::class,'question'])->middleware(['auth','verified','student']);
    Route::get('/contact',[contactController::class,'index']);
    Route::post('/contact/message/send',[contactController::class,'send']);
    Route::get('/profile',[profileController::class,'index'])->middleware(['auth','verified','student']);
       
});

Route::post('/exams/start/{id}',[Examcontroller::class,'start'])->middleware(['auth','verified','student','can-enter-exam']);
Route::post('/exams/submit/{id}',[Examcontroller::class,'submit'])->middleware(['auth','verified','student']);


Route::get('lang/set/{lang}',[langController::class,'set']);


Route::prefix('dashboard')->middleware(['auth','verified','can-enter-dashboard'])->group(function(){

    // cat
    Route::get('/',[AdminHomeController::class,'index']);
    Route::get('/cats',[AdminCatController::class,'index']);
    Route::post('/cats/store',[AdminCatController::class,'store']);
    Route::post('/cats/update',[AdminCatController::class,'update']);
    Route::get('/cats/toggle/{cat}',[AdminCatController::class,'toggle']);
    Route::get('/cats/delete/{cat}',[AdminCatController::class,'delete']);

    // skill

    Route::get('/skills',[AdminSkillController::class,'index']);
    Route::post('/skills/store',[AdminSkillController::class,'store']);
    Route::post('/skills/update',[AdminSkillController::class,'update']);
    Route::get('/skills/toggle/{skill}',[AdminSkillController::class,'toggle']); //route model binding
    Route::get('/skills/delete/{skill}',[AdminSkillController::class,'delete']);

    // exams 
    Route::get('/exams',[AdminExamController::class,'index']);
    Route::get('/exams/show/{exam}',[AdminExamController::class,'show']);
    Route::get('/exams/show-questions/{exam}',[AdminExamController::class,'showQuestions']);

    Route::get('/exams/create',[AdminExamController::class,'create']);
    Route::post('/exams/store',[AdminExamController::class,'store']);

    Route::get('/exams/edit/{exam}',[AdminExamController::class,'edit']);
    Route::post('/exams/update/{exam}',[AdminExamController::class,'update']);

    Route::get('/exams/create-questions/{exam}',[AdminExamController::class,'createQuestions']);
    Route::post('/exams/store-questions/{exam}',[AdminExamController::class, 'storeQuestions']);
     

    Route::get('/exams/edit-question/{exam}/{question}',[AdminExamController::class,'editQuestion']);
    Route::post('/exams/update-question/{exam}/{question}',[AdminExamController::class, 'updateQuestion']);


    Route::get('/exams/edit',[AdminExamController::class,'edit']);
    Route::post('/exams/update',[AdminExamController::class,'update']);
    Route::get('/exams/toggle/{exam}',[AdminExamController::class,'toggle']); //route model binding
    Route::get('/exams/delete/{exam}',[AdminExamController::class,'delete']);

// student

    Route::get('/students',[StudentController::class,'index']);
    Route::get('/students/show-scores/{id}',[StudentController::class,'showScores']);
    Route::get('/students/open-exam/{studentId}/{examId}',[StudentController::class,'openExam']);
    Route::get('/students/close-exam/{studentId}/{examId}',[StudentController::class,'closeExam']);

//admin & superadmin

Route::middleware('superadmin')->group(function(){
    Route::get('/admins',[AdminController::class,'index']);
    Route::get('/admins/create',[AdminController::class,'create']);
    Route::post('/admins/store',[AdminController::class,'store']);

    Route::get('/admins/promote/{id}',[AdminController::class,'promote']);
    Route::get('/admins/demote/{id}',[AdminController::class,'demote']);

    // messeges
    Route::get('/messeges',[MessegController::class,'index']);
    Route::get('/messeges/show/{messege}',[MessegController::class,'show']);
    Route::post('/messeges/response/{messege}',[MessegController::class,'response']);

});


 




});

 
