<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GardeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PharmacieController;
use App\Http\Middleware\admin;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;
use App\Models\ville;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Completion\Suggestion;

Route::get('/', function () {
    
    return redirect('home');
});
Route::prefix('suggestion')->middleware('auth')->group(function(){
    Route::post('/add',[SuggestionController::class,'storeSuggestion']);
    Route::get('/user-list',[SuggestionController::class,'userList']);
    Route::post('/approve',[SuggestionController::class,'approuver'])->name('approve');
    Route::post('/disapprove',[SuggestionController::class,'desapprouver'])->name('disapprove')->middleware(admin::class);
    Route::get('/list',[SuggestionController::class,'suggestionList'])->middleware(admin::class);
});
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login', [LoginController::class, 'check']);
Route::get('/home',function(){
    $villes=ville::all();
    return view('home',compact('villes'));
})->name('home');
Route::prefix('/pharmacie')->middleware(['auth',admin::class])->group(function(){
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
Route::prefix('/garde')->middleware(['auth',admin::class])->group(function(){ 
    Route::get('/add',[GardeController::class,'create']);
    Route::post('/add',[GardeController::class,'store']);
    Route::get('/edit/{garde}',[GardeController::class,'edit']);
    Route::post('/edit/{garde}',[GardeController::class,'update']);
    Route::get('/list',[GardeController::class,'list']);
    Route::get('/delete/{garde}',[GardeController::class,'destroy']);
    Route::post('date/filter',[GardeController::class,'gardesParDate'])->name('filterDate');
});
Route::prefix('/user')->middleware(['auth',admin::class])->group(function(){
    Route::get('/list',[UserController::class,'list'])->name('userlist');
    Route::get('/add',[UserController::class,'create']);
    Route::post('/add',[UserController::class,'store']);
    Route::get('/edit/{user}',[UserController::class,'edit']);
    Route::post('/edit/{user}',[UserController::class,'update']);
    Route::get('/delete/{user}',[UserController::class,'destroy']);

});
Route::get('/dashboard',[DashboardController::class,'dashboard'])->middleware([admin::class]);

Route::get("/logout", [LogoutController::class,'logout'])->name('logout');
Route::get("/test",function(){
    return view('shared.admin');
});
Route::post("/pharmacies_garde_nuit",[HomeController::class,'pharmaciesGardeNuit'])->name('GardeNuit');
Route::post("/pharmacies_garde_jour",[HomeController::class,'pharmaciesGardeJour'])->name('GardeJour');
Route::post("/pharmacies_garde_all_day",[HomeController::class,'pharmaciesGardeAllDay'])->name('GardeAllDay');
Route::post("/pharmacies",[HomeController::class,'pharmaciesVille'])->name('pharmacies');
Route::get("/user_profil",function(){
    $user=Auth::user();
    return view("users.profil",compact('user'));
})->middleware('auth');
/*Route::middleware(["auth",admin::class])->get("/test",function(){
    return view("testpage");
});*/
Route::get("/contactez-nous",[ContactController::class,'contact_form']);

Route::post("/contactez-nous",[ContactController::class,'contact_us']);