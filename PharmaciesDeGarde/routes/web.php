<?php

use App\Http\Controllers\GardeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\admin;
use App\Http\Controllers\RegisterController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login', [LoginController::class, 'check']);
Route::get('/home',function(){
    return view('home');
})->name('home');
Route::prefix('/pharmacie')->middleware('auth')->group(function(){
    /*Route::get('/list',[PharmacieController::class,'index']);*/
    Route::get('/create',[PharmacieController::class,'create']);
    Route::post('/create',[PharmacieController::class,'store']);
    Route::get('/edit/{pharmacie}',[PharmacieController::class,'edit'])->name('edit');
    Route::post('/edit/{pharmacie}',[PharmacieController::class,'update']);
    Route::get('/garde/add',[GardeController::class,'create']);
    Route::post('/garde/add',[GardeController::class,'store']);
   Route::get('/garde/edit/{garde}',[GardeController::class,'edit']);
    Route::post('/garde/edit/{garde}',[GardeController::class,'update']); });
   /*Route::prefix('/tasks')->middleware('auth')->group(function(){
    Route::get('/list',[TaskController::class,'index']);
    Route::get('/create',[TaskController::class,'create']);
    Route::post('/create',[TaskController::class,'store']);
   
    Route::get('/delete/{task}',[TaskController::class,'delete'])->name('delete');
*/


Route::get("/logout", [LogoutController::class,'logout'])->name('logout');
/*Route::middleware(["auth",admin::class])->get("/test",function(){
    return view("testpage");
});*/
