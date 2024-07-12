<?php

use App\Http\Controllers\GardeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PharmacieController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\admin;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
    Route::get('/add',[PharmacieController::class,'create']);
    Route::post('/add',[PharmacieController::class,'store']);
    Route::get('list',[PharmacieController::class,'list']);
    Route::get('/edit/{pharmacie}',[PharmacieController::class,'edit'])->name('edit');
    Route::post('/edit/{pharmacie}',[PharmacieController::class,'update']);
    Route::get('/delete/{pharmacie}',[PharmacieController::class,'destroy']);
    Route::post('/ville/filter',[PharmacieController::class,'pharmaciesVille'])->name('filterCity'); });
   /*Route::prefix('/tasks')->middleware('auth')->group(function(){
    Route::get('/list',[TaskController::class,'index']);
    Route::get('/create',[TaskController::class,'create']);
    Route::post('/create',[TaskController::class,'store']);
   
    Route::get('/delete/{task}',[TaskController::class,'delete'])->name('delete');
*/
Route::prefix('/garde')->middleware('auth')->group(function(){ 
    Route::get('/add',[GardeController::class,'create']);
    Route::post('/add',[GardeController::class,'store']);
    Route::get('/edit/{garde}',[GardeController::class,'edit']);
    Route::post('/edit/{garde}',[GardeController::class,'update']);
    Route::get('/list',[GardeController::class,'list']);
    Route::post('date/filter',[GardeController::class,'gardesParDate'])->name('filterDate');
});
Route::prefix('/user')->middleware('auth')->group(function(){
    Route::get('/list',[UserController::class,'list'])->name('userlist');
    Route::get('/add',[UserController::class,'create']);
    Route::post('/add',[UserController::class,'store']);
    Route::get('/edit/{user}',[UserController::class,'edit']);
    Route::post('/edit/{user}',[UserController::class,'update']);

});

Route::get("/logout", [LogoutController::class,'logout'])->name('logout');
Route::get("/test",function(){
    return view('shared.admin');
});
/*Route::middleware(["auth",admin::class])->get("/test",function(){
    return view("testpage");
});*/
