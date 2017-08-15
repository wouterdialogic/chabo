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

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/chat2', function () {
    return view('chat2');
});

Route::put('/button_click', function () {
    return "you did it!";
});

Route::put('/mouse_entered', function () {
    return "you did it! mouse!";
});

Route::post('/button_click', function () {
    return "you did it!";
});

Route::post('/edit/{id}', 'Chatbot@edit');
Route::get('/edit/{id}', 'Chatbot@edit');

Route::post('/mouse_entered', 'Chatbot@userSendsMessage');

Route::get('/mouse_entered', function () {
    return "you did it! mouse!";
});