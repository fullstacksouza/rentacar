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

$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
$this->get('teste', 'HomeController@teste');


$this->get('/home', 'HomeController@index')->name('home')->middleware("auth");

$this->post('login', 'LoginController@auth');

$this->post('/logout', 'Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
$this->get('user/change-pass', function () {
    return view("dashboard/users/change-password");
});

//rotas com o prefixo admin utilizam  os controller na pasta Controller\Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    //USERS ROUTES
    Route::get('/users/create', 'UserController@create');
    $this->post("users/create", 'UserController@store');

    $this->get('/users/list', 'UserController@list');

    $this->get('users/{id}/edit', 'UserController@edit');
    $this->post('users/{id}/edit', 'UserController@update');

    $this->post('users/{id}/delete', 'UserController@delete');

    //SECTORS ROUTES
    $this->get('sectors/create', 'SectorController@create');
    $this->post('sectors/create', 'SectorController@store');

    $this->get('sectors/list', 'SectorController@list');

    $this->get('sectors/{id}/edit', 'SectorController@edit');
    $this->post('sectors/{id}/edit', 'SectorController@update');

    $this->post('sectors/{id}/delete', 'SectorController@delete');

    $this->post('users/change-pass', 'UserController@changePass');

    $this->get('searches/create', 'SearchController@create');
    $this->post('searches/create', 'SearchController@store');

    $this->get('search/{id}/questions/create', 'QuestionController@create')->middleware('create-questions');
    $this->get('searches/list', 'SearchController@list');
    $this->post('search/{id}/questions/create', 'SearchController@addQuestions');

    $this->get("search/{id}/preview", 'SearchController@previewSearch');
    $this->post('search/{id}/publish', 'SearchController@publishSearch')->name('search.publish');
    $this->get('search/{id}/details', 'SearchController@details')->name('search.details');
    $this->post('search/{id}/action/register', 'SearchController@actionRegister')->name('action.register');
    $this->get("search/{id}/send-notification", "Admin\SearchController@sendNotification");
    $this->post('searches/{id}/delete', 'SearchController@delete');

});

Route::group(['namespace' => "Front"], function () {

    $this->get("user/searches", "UserController@getSearches");
    $this->get("user/searches/{id}/reply", "UserController@replySearch")->name("search.reply")->middleware('search');
    $this->post("user/searches/{id}/reply", "UserController@sendAnswers")->name("search.reply");
    $this->get("user/searches/{id}/get", "UserController@searchJson");

});
