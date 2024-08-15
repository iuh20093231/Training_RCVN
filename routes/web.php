<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
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
    Route::post('/product/add',[ProductController::class,'store'])->name('product.add');
    Route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/{id}',[ProductController::class,'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    //CUSTORMER
    Route::get('/custormer',[CustomerController::class,'index'])->name('custormer.index');
    Route::get('/custormer/list',[CustomerController::class,'getCustomer'])->name('custormer.list');
    Route::get('/custormer/add',[CustomerController::class,'create'])->name('custormer.create');
    Route::post('/custormer/add',[CustomerController::class,'store'])->name('custormer.add');
    Route::get('/custormer/{id}',[CustomerController::class,'show'])->name('custormer.show');
    Route::put('/custormer/{id}',[CustomerController::class,'update'])->name('custormer.update');
    Route::post('import',[CustomerController::class,'import'])->name('import');
    Route::get('/export',[CustomerController::class,'export'])->name('export');
    Route::delete('/custormer/{id}',[CustomerController::class,'destroy'])->name('custormer.destroy');
    //USER
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/list',[UserController::class,'getUsers'])->name('users.list'); 
    Route::get('/users/add',[UserController::class,'create'])->name('users.create');
    Route::post('/users/add',[UserController::class,'store'])->name('users.add');
    Route::get('/users/{id}',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/updatestatus', [UserController::class, 'updateStatus']);
    // VUEJS
    Route::get('/manager-task', function () {
        $tittle = 'Task';
        return view('task.index',compact("tittle"));
    })->name('task');
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/update-order', [TaskController::class, 'updateOrder']);
});

