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

Route::get('user/test', function() {
    return "Hello";
});

Auth::routes();

Route::group(['middleware' => 'web'], function(){
  Route::get('user/profil', 'UserController@profil')->name('user.profil');
  Route::patch('user/{id}/change', 'UserController@changeProfil');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web', 'cekuser:1']], function(){
  Route::get('kategori/data', 'KategoriController@listData')->name('kategori.data');
  Route::resource('kategori', 'KategoriController');

  Route::get('produk/data', 'ProdukController@listData')->name('produk.data');
  Route::post('produk/hapus', 'ProdukController@deleteSelected');
  Route::post('produk/cetak', 'ProdukController@printBarcode');
  Route::resource('produk', 'ProdukController');

  Route::get('supplier/data', 'SupplierController@listData')->name('supplier.data');
  Route::resource('supplier', 'SupplierController');

  Route::get('member/data', 'MemberController@listData')->name('member.data');
  Route::resource('member/cetak', 'MemberController@printCard');
  Route::resource('member', 'MemberController');

  Route::get('pengeluaran/data', 'PengeluaranController@listData')->name('pengeluaran.data');
  Route::resource('pengeluaran', 'PengeluaranController');

  Route::get('user/data', 'UserController@listData')->name('user.data');
  Route::resource('user', 'UserController');

  Route::get('pembelian/data', 'PembelianController@listData')->name('pembelian.data');
  Route::get('pembelian/{id}/tambah', 'PembelianController@create');
  Route::get('pembelian/{id}/lihat', 'PembelianController@show');
  Route::resource('pembelian', 'PembelianController');

  Route::get('pembelian_detail/{id}/data', 'PembelianDetailController@listData')->name('pembelian_detail.data');
  Route::get('pembelian_detail/loadform/{diskon}/{total}', 'PembelianDetailController@loadForm');
  Route::resource('pembelian_detail', 'PembelianDetailController');
});
