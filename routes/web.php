<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

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
Route::get('/',[LoginController::class,'index']);
Route::get('/login',[LoginController::class,'index'])->name('login');
//login
Route::post('/login',[LoginController::class,'login']);
Route::group(['middleware'=> Authenticate::class], function()
{
    //PRODUCT
    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    //CUSTORMER
    Route::get('/custormer',[CustomerController::class,'index'])->name('custormer.index');
    Route::get('/custormer/list',[CustomerController::class,'getCustomer'])->name('custormer.list');
    Route::get('custormer/add',[CustomerController::class,'create'])->name('custormer.create');
    Route::post('custormer/add',[CustomerController::class,'store'])->name('custormer.add');
    //USER
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/list',[UserController::class,'getUsers'])->name('users.list'); // lấy dữ liệu JSON
    Route::get('/users/add',[UserController::class,'create'])->name('users.create');
    Route::post('/users/add',[UserController::class,'store'])->name('users.add');
    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
});

