<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

//Category Controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category');
route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');
Route::get('category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('category/update/{id}',[CategoryController::class,'Update']);
Route::get('softdelete/category/{id}',[CategoryController::class,'SoftDelete']);





Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
            // $users =User::all();
        $users=DB::table('users')->get();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
