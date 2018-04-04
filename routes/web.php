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
Route::get('teste','HomeController@teste');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('login','LoginController@auth');

Route::post('/logout','Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rotas com o prefixo admin utilizam  os controller na pasta Controller\Admin
Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>'auth'], function()
{
    //USERS ROUTES
    Route::get('/users/create', 'UserController@create');
    $this->post("users/create",'UserController@store');

    $this->get('/users/list','UserController@list');

    $this->get('users/{id}/edit','UserController@edit');
    $this->post('users/{id}/edit','UserController@update');

   
    //SECTORS ROUTES
    $this->get('sectors/create','SectorController@create');
    $this->post('sectors/create','SectorController@store');

    $this->get('sectors/list','SectorController@list');

    $this->get('sectors/{id}/edit','SectorController@edit');
    $this->post('sectors/{id}/edit','SectorController@update');

    $this->get("user/{id}/delete","UserController@delete");

    $this->get('user/change-pass',function(){
        return view("dashboard/users/change-password");
    });

    $this->post('users/change-pass','UserController@changePass');
});