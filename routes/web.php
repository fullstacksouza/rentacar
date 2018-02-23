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

Route::get('/','Auth\LoginController@showLoginForm')->name('login');


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rotas com o prefixo admin utilizam  os controller na pasta Controller\Admin
Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>'auth'], function()
{
    Route::get('/users/create', ['middleware' => ['permission:create_user'], 'uses' => 'UserController@create']);
    $this->get('user/list',function (){
        return view('dashboard/users/list');
    });

    $this->post("users/create",'UserController@store');
    $this->get('test','SectorController@store');
});