<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('/iul-submit', function (Request $request) {
    // dd($request->input('file-add'));
    dd($request);
});

Route::get('role', function () {
    $user = Auth::user(); // Получаем текущего аутентифицированного пользователя
    $roles = $user->roles;
    return $roles; // Возвращаем пользователя
});
