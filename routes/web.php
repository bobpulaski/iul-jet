<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ThanksController;
use App\Services\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/blog', function () {
    $postClass = new Post;

    $posts = $postClass->getLatest(5);

    return view('blog', compact('posts'));

});

Route::get('blog/{slug}', [ArticleController::class, 'index'])->name('article');



// Создание платежа
Route::get('/payment/create', [PaymentController::class, 'create'])
    ->name('payment.create');

// Webhook endpoint для YooKassa
Route::post('/webhook/yookassa', [PaymentController::class, 'webhook'])
    ->name('webhook.yookassa');

// Страницы успеха и ошибки
Route::get('/payment/success', [PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/payment/failure', [PaymentController::class, 'failure'])
    ->name('payment.failure');



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

    Route::get('thanks', [ThanksController::class, 'index'])->name('thanks');

//    Route::get('/thanks', function () {
//        return view('thanks');
//    })->name('thanks');


    Route::get('/html-report', function () {
        $data = session('reportData');
        return view('iul-html', ['data' => $data]);
    })->name('htmlreport');
});

