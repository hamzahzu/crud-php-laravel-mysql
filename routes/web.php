<?php

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

Route::get('/pegawai', 'PegawaiController@actionGetPegawai')->name('pegawai');
Route::get('/form-pegawai', 'PegawaiController@actionGetForm')->name('get-form-pegawai');
Route::post('/form-pegawai', 'PegawaiController@actionPostForm')->name('post-form-pegawai');
Route::get('/edit-pegawai/{id}', 'PegawaiController@actionEditPegawai')->name('get-edit-pegawai');
Route::post('/edit-pegawai', 'PegawaiController@actionPostEditPegawai')->name('post-edit-pegawai');