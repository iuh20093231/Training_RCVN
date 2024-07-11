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
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
//login
Route::post('/login',[LoginController::class,'login']);
Route::group(['middleware'=> Authenticate::class], function()
{
    //PRODUCT
    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    Route::get('/product/list',[ProductController::class,'getProduct'])->name('product.list');
    Route::get('/product/add',[ProductController::class,'create'])->name('product.create');
    //CUSTORMER
    Route::get('/custormer',[CustomerController::class,'index'])->name('custormer.index');
    Route::get('/custormer/list',[CustomerController::class,'getCustomer'])->name('custormer.list');
    Route::get('/custormer/add',[CustomerController::class,'create'])->name('custormer.create');
    Route::post('/custormer/add',[CustomerController::class,'store'])->name('custormer.add');
    Route::get('/custormer/{id}',[CustomerController::class,'show'])->name('custormer.show');
    Route::put('/custormer/{id}',[CustomerController::class,'update'])->name('custormer.update');
    Route::post('/custormer/import',[CustomerController::class,'import'])->name('custormer.import');
    Route::get('/custormer/export',[CustomerController::class,'export'])->name('custormer.export');
    //USER
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/list',[UserController::class,'getUsers'])->name('users.list'); // lấy dữ liệu JSON
    Route::get('/users/add',[UserController::class,'create'])->name('users.create');
    Route::post('/users/add',[UserController::class,'store'])->name('users.add');
    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/updatestatus', [UserController::class, 'updateStatus']);
    
});

