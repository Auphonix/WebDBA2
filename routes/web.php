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
    return view('static_pages/home');
})->name('home');

Route::get('/faq', function () {
   return view('static_pages/faq');
})->name('faq');

Route::resource('ticket', 'TicketController', ['except' => ['destroy']]);
Route::resource('comment', 'CommentController', ['only' => ['store']]);