<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::view('allposts', 'allposts');
Route::view('addpost', 'addpost');
Route::view('singlepost', 'singlepost');
Route::view('userprofile', 'userprofile');
Route::view('signup', 'signup');




