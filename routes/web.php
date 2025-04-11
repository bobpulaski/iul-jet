<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard/{id?}', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/signs', function () {
        return view('signs-list');
    })->name('signs');

    Route::get('/history', function () {
        return view('history');
    })->name('history');

    Route::get('/support', function () {
        return view('support');
    })->name('support');



    Route::get('/html-report', function () {
        $data = session('reportData');
        return view('iul-html', ['data' => $data]);
    })->name('htmlreport');
});

