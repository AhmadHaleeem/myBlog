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

Route::get('/test', 'PagesController@index');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');

Route::get('/logout', 'SessionController@destroy');

Route::get('/register', 'RegisterController@create');
Route::post('/register', 'RegisterController@store');

Route::get('/posts', "PagesController@posts");
Route::post('/posts/store', "PagesController@store");
Route::get('/post/{post}', "PagesController@post");

Route::get('/users', "PagesController@admin");
Route::get('/category/{name}', "PagesController@category");

Route::get('posts/{post}/destroy','PagesController@destroy');
Route::get('/{comment}/delete','CommentsController@delete');

Route::post('/{post}/store', "CommentsController@store");
// middleware
// first way
Route::get('/admin', [
    'uses' => 'PagesController@admin',
    'as'   => 'content.admin',
    'middleware' => 'roles',
    'roles'     => ['admin']
]);

Route::post('/add_role', [
    'uses' => 'PagesController@addRole',
    'as'   => 'content.admin',
    'middleware' => 'roles',
    'roles'     => ['admin']
]);

 // this is the second way
//Route::group(['middleware' => 'roles', 'roles' => ['admin']], function () {
//    Rotue::get('/admin', 'PagesController@admin');
//    Rotue::get('/add_role', 'PagesController@addRole');
//});


   Route::post('/like', 'PagesController@like')->name('likes');
    Route::post('/dislike', 'PagesController@dislike')->name('dislikes');



Route::post('/search', function (\Illuminate\Http\Request $request) {
   $searchs = Search::search(
        "Post" , // this is the name of the model..
        ['title' , 'body'] , // this is the fields which i want to search in..
        $request->search  , // this is to get the result..
        ['id', 'title', 'body', 'url', 'created_at'], // this is the fields which i want to get from the database..
        ['id'  , 'asc'] ,
        true ,
        30
    );
    return view('content.search', compact('searchs'));
});