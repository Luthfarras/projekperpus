<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//petugas
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
  return Auth::user()->level;
})->middleware('jwt.verify');
Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

// buku
Route::get('/buku','BukuController@index')->middleware('jwt.verify');
Route::post('/simpan_buku','BukuController@store')->middleware('jwt.verify');
Route::put('/ubah_buku/{id}','BukuController@update')->middleware('jwt.verify');
Route::get('/tampil_buku','BukuController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_buku/{id}','BukuController@destroy')->middleware('jwt.verify');

// anggota
Route::get('/anggota','AnggotaController@index')->middleware('jwt.verify');
Route::post('/simpan_anggota','AnggotaController@store')->middleware('jwt.verify');
Route::put('/ubah_anggota/{id}','AnggotaController@update')->middleware('jwt.verify');
Route::get('/tampil_anggota','AnggotaController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_anggota/{id}','AnggotaController@destroy')->middleware('jwt.verify');

// peminjaman
Route::get('/peminjaman','PinjamController@index')->middleware('jwt.verify');
Route::post('/tambah_pinjam','PinjamController@store')->middleware('jwt.verify');
Route::put('/ubah_pinjam/{id}','PinjamController@update')->middleware('jwt.verify');
Route::get('/tampil_pinjam','PinjamController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_pinjam/{id}','PinjamController@destroy')->middleware('jwt.verify');

// detail_peminjaman
Route::post('/simpan_detail','PinjamController@simpan')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','PinjamController@ubah')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','PinjamController@hapus')->middleware('jwt.verify');
// Route::get('/tampil_detail','PinjamController@tampil_detail')->middleware('jwt.verify');
