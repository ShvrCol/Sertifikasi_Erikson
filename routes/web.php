<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


//BUAT LOGIN
Route::get('/login', 'App\Http\Controllers\UserController@loginIndex');
Route::post('/login', 'App\Http\Controllers\UserController@send_login');

// insert routing peminjam
Route::post('/peminjaman', 'App\Http\Controllers\UserController@send_addpeminjaman');


//get function dari controller untuk koleksi buku pada page member
Route::get('/', 'App\Http\Controllers\UserController@send_koleksi');

//get function dari controller untuk koleksi buku pada page admin
Route::get('/dashboardadmin', 'App\Http\Controllers\UserController@send_dashadmin');

//get function dari controller untuk members pada page admin
Route::get('/members', 'App\Http\Controllers\UserController@send_adminmembers');

//get function delete members dari controller
Route::post('/members', 'App\Http\Controllers\UserController@send_deletemembers');

//get function update stok dari controller
Route::post('/updatestok', 'App\Http\Controllers\UserController@send_updatestok');

//get function to show image
Route::post('/dashboardadmin', 'App\Http\Controllers\UserController@send_AddImg');

Route::get('/peminjaman', function () {
    return view('peminjaman');
});

Route::get('/updatestok', function () {
    return view('updatestok');
});
