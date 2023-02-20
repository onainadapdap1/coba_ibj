<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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
Route::view('adminLogin', 'Admin/Login')->name('adminLogin');
Route::group([['middleware' => 'admin:admin-api']], function () {

    Route::post('adminLogout', [AdminController::class, 'adminLogout'])->name('adminLogout');
    Route::get('me', [AdminController::class, 'me']);
    Route::post('createcoursecategory', [CourseCategoryController::class, 'createCategory']);
    Route::post('updatecoursecategory/{id}', [CourseCategoryController::class, 'updateCategory']);
    // course
    Route::post('createcourse', [CourseController::class, 'createCourse']);

    // Route::post('updatecourse/{id}', [CourseController::class, 'updateCourse']);
});

Route::post('userRegister', [UserController::class, 'userRegister'])->name('userRegister');
Route::post('userLogin', [UserController::class, 'userLogin'])->name('userLogin');
Route::group([['middleware' => 'auth:user-api']], function () {

    Route::post('userLogout', [UserController::class, 'userLogout'])->name('userLogout');
    Route::get('meuser', [UserController::class, 'me']);

});
