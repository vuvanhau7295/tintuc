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
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});
Route::get('test',function(){
  $data = TheLoai::find(1);
  $data = $data->loaitin()->get();
  echo "Ten The Loai Id = 1 <br>";
  foreach ($data as $key => $value) {
    echo $value->Ten."<br>";
  }
});

Route::group(['prefix'=>'admin'],function (){
    Route::group(['prefix'=>'theloai'],function (){
        Route::get('danhsach','tintucController@getDanhsach');
        Route::get('sua/{id}','tintucController@getSua');
        Route::post('sua/{id}','tintucController@postSua');

        Route::get('them','tintucController@getThem');
        Route::post('them','tintucController@postThem');

        Route::get('xoa/{id}','tintucController@getXoa');
    });

    Route::group(['prefix'=>'loaitin'],function (){
        Route::get('danhsach','LoaiTinController@getDanhsach');
//        Them
        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');
    });

    Route::group(['prefix'=>'tintuc'],function (){
        Route::get('danhsach','tintucController@getDanhsach');
        Route::get('sua','tintucController@getSua');
        Route::get('them','tintucController@getThem');
    });

});