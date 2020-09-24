<?php
// Login
Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/exit', 'LoginController@exit');

// Dashboard
Route::get('/home', 'HomeController@Home');

// Semester
Route::get('/semester', 'SemesterController@Semester');
Route::get('/semester/create', 'SemesterController@SemesterCreate');
Route::post('/semester/store', 'SemesterController@SemesterStore');
Route::get('/semester/delete', 'SemesterController@SemesterDelete');

// CA
Route::get('/casualAcademic', 'CasualAcademicController@CasualAcademic');
Route::get('/casualAcademic/create', 'CasualAcademicController@CasualAcademicCreate');

//test
