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

Route::put('/button_click', function () {
    return "you did it!";
});

Route::put('/mouse_entered', function () {
    return "you did it! mouse!";
});

Route::post('/button_click', function () {
    return "you did it!";
});

Route::post('/mouse_entered', 'Chatbot@userSendsMessage');
	//echo "<pre>";
	//print_r($request);
	//echo "</pre>";

    //$data['message'] = $message;
    // $data['lastName'] = $lastName;

    // if ($data['message'] == "Fred" ) {
    // 	$data['output'] = "ah yes, fred";
    // } else {
    // 	$data['output'] = "this is not fred!";
   	//e//cho 

    // }
// 


   // return $request;
//});

Route::get('/mouse_entered', function () {
    return "you did it! mouse!";
});