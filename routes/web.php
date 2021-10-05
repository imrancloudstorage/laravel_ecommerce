<?php

use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category/all', [CategoryController::class,'Allcat'])->name('all.category');

Route::post('/category/add', [CategoryController::class,'Addcat'])->name('store.category');


Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);
Route::post('/category/update/{id}', [CategoryController::class,'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class,'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class,'Restore']);

Route::get('/pdelete/category/{id}', [CategoryController::class,'PDelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
   // $users = User::all();

   

   $users = DB::table('users')->get();

    return view('dashboard',compact('users'));
})->name('dashboard');
