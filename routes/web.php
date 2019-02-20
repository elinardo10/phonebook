<?php


Route::get('/', function () {
    return view('/phonebook');
});

Route::resource('phonebook', 'PhonebookController');