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
        return view('home');
    });
    
    Route::get('/buy', 'BuyBookController@findAllBooks');
        
    Route::post('/edit_buy', 'BuyBookController@editBook');
    
    Route::post('/add_buy', 'BuyBookController@addBook');
    
    Route::post('/delete_buy', 'BuyBookController@deleteBook');
   
    Route::get('/owned', 'OwnedBookController@findAllBooks');
    
    Route::post('/edit_owned', 'OwnedBookController@editBook');
    
    Route::post('/add_owned', 'OwnedBookController@addBook');
    
    Route::post('/delete_owned', 'OwnedBookController@deleteBook');
