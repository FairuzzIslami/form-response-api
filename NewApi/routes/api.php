<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Form;
use App\Http\Controllers\FormApiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserController;

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.bearer');

// Form
Route::post('/v1/form', [FormApiController::class, 'store']);
Route::get('/v1/form', [FormApiController::class, 'getform']);
Route::get('/v1/form/{slug}', [FormApiController::class, 'detail']);

// Question
Route::post('/v1/form/{slug}/questions',[QuestionController::class,'store'])->middleware('auth.bearer');
Route::delete('/v1/form/{slug}/questions/{id}',[QuestionController::class,'delete'])->middleware('auth.bearer');


// Response
Route::post('/v1/form/{slug}/response',[ResponseController::class,'store'])->middleware('auth.bearer');
Route::get('/v1/form/{slug}/response',[ResponseController::class,'getResponse'])->middleware('auth.bearer');

// User
Route::get('/list', [UserController::class, 'index']);
Route::get('/user', function (Request $request) {
    return response()->json($request->user);
})->middleware('auth.bearer');
