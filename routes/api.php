<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\ToDoController;
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


model
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(UserController::class)->middleware("auth")->group(function () {
    Route::post('/updateUser/{user}', 'updateUser')->name('updateUser');
});

Route::controller(ListController::class)->middleware("auth")->group(function () {
    Route::post('/storeList', 'store')->name('storeList');
});

Route::controller(ListController::class)->middleware("auth")->group(function () {
    Route::post('/syncList/{todoList}', 'sync')->name('syncList');
});


Route::controller(ToDoController::class)->middleware("auth")->group(function () {

    Route::post('/syncUserTodo/{todoItem}', 'syncUser')->name('syncUserTodo');
});

Route::controller(ToDoController::class)->middleware("auth")->group(function () {
    Route::post('/syncStateTodo/{todoItem}', 'syncState')->name('syncStateTodo');
});

Route::controller(ToDoController::class)->middleware("auth")->group(function () {
    Route::post('/syncDataTodo/{todoItem}', 'syncData')->name('syncDataTodo');
});

Route::controller(ToDoController::class)->middleware("auth")->group(function () {
    Route::post('/storeTodo', 'store')->name('storeTodo');
});

Route::controller(ToDoController::class)->middleware("auth")->group(function () {
    Route::post('/deleteTodo/{todoItem}', 'delete')->name('deleteTodo');
});
