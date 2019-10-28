<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shares', 'ShareController');
Route::resource('noticias', 'NoticiaController');
Route::resource('tags', 'TagController');
Route::resource('areas', 'AreaController');
Route::resource('usuarios', 'usuarioController');