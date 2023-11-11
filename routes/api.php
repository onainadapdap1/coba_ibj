<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('adminRegister', [AdminController::class, 'adminRegister'])->name('adminRegister');
Route::post('adminLogin', [AdminController::class, 'adminLogin'])->name('adminLogin');

Route::middleware(['admin:admin-api'])->group( function () {
    // there is an update here
    Route::post('adminLogout', [AdminController::class, 'adminLogout'])->name('adminLogout');
    Route::get('me', [AdminController::class, 'me']);
    // course category
    Route::post('createcoursecategory', [CourseCategoryController::class, 'createCategory']);
    Route::post('updatecoursecategory/{id}', [CourseCategoryController::class, 'updateCategory']);
    Route::post('destroycoursecategory/{id}', [CourseCategoryController::class, 'destroycategory']);
    Route::post('restorecoursecategory/{id}', [CourseCategoryController::class, 'restorecategory']);
    Route::get('getallcategories', [CourseCategoryController::class, 'getAllCategories']);
    Route::get('getonecategory/{id}', [CourseCategoryController::class, 'getOneCategory']);
    // course
    Route::post('createcourse', [CourseController::class, 'createCourse']);
    Route::post('updatecourse/{id}', [CourseController::class, 'updateCourse']);
    Route::post('destroycourse/{id}', [CourseController::class, 'destroyCourse']);
    Route::post('restorecourse/{id}', [CourseController::class, 'restoreCourse']);
    Route::get('getallcourse', [CourseController::class, 'getAllCourse']);
    Route::get('getonecourse/{id}', [CourseController::class, 'getOneCourse']);
});

Route::post('userRegister', [UserController::class, 'userRegister'])->name('userRegister');
Route::post('userLogin', [UserController::class, 'userLogin'])->name('userLogin');
Route::group([['middleware' => 'auth:user-api']], function () {

    Route::post('userLogout', [UserController::class, 'userLogout'])->name('userLogout');
    Route::get('meuser', [UserController::class, 'me']);
    Route::post('createusercourse', [UserCourseController::class, 'createUserCourse']);
    Route::post('updateusercourse/{id}', [UserCourseController::class, 'updateUserCourse']);
    Route::post('deleteusercourse/{id}', [UserCourseController::class, 'destroyUserCourse']);
    Route::get('showusercourse', [UserCourseController::class, 'showUserCourse']);
});
