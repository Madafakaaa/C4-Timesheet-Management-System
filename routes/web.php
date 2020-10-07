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
Route::post('/casualAcademic/store', 'CasualAcademicController@CasualAcademicStore');
Route::get('/casualAcademic/delete', 'CasualAcademicController@CasualAcademicDelete');

// UC
Route::get('/coordinator ', 'CoordinatorController@Coordinator');
Route::get('/coordinator/create ', 'CoordinatorController@CoordinatorCreate');

//Uos
Route::get('/uos ', 'UosController@Uos');
Route::get('/uos/create ', 'UosController@UosCreate');

//Tutorial
Route::get('/tutorial ', 'TutorialController@Tutorial');
Route::get('/tutorial/assign ', 'TutorialController@TutorialAssign');
Route::get('/tutorial/create ', 'tutorialController@TutorialCreate');

//Admin-User
Route::get('/adminUser', 'AdminUserController@AdminUser');
Route::get('/adminUser/create', 'AdminUserController@AdminUserCreate');
Route::post('/adminUser/store', 'AdminUserController@AdminUserStore');
Route::get('/adminUser/delete', 'AdminUserController@AdminUserDelete');
Route::get('/adminUser/edit', 'AdminUserController@AdminUserEdit');



//test
