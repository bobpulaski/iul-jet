<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use YooKassa\Client;

class PaymentController extends Controller
{
    // Создание платежа
    public function create(Request $request)
    {
        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        $amount = $request->query('amount', 500);
        $user_name = $request->query('user_name');
        $user_email = $request->query('user_email');


        $payment = $client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('payment.success'),
            ],
            'metadata' => [
                'order_id' => 999,
                'user_id' => auth()->id(),
                'user_name' => $user_name,
                'user_email' => $user_email
            ],
            'capture' => true,
            'description' => 'Тестовый платеж',
            'test' => config('services.yookassa.test_mode', true),
        ], uniqid('', true));

        return redirect($payment->getConfirmation()->getConfirmationUrl());
    }

    // Webhook обработчик
    public function webhook(Request $request)
    {
        Log::info('YooKassa Webhook received:', $request->all());

        // Проверяем тип события
        if ($request->input('event') === 'payment.succeeded') {
            $paymentId = $request->input('object.id');
            $status = $request->input('object.status');
            $metadata = $request->input('object.metadata', []);

            // Обрабатываем успешный платеж
            $this->handleSuccessfulPayment($paymentId, $status, $metadata);

        } elseif ($request->input('event') === 'payment.canceled') {
            // Обрабатываем отмененный платеж
            $this->handleCanceledPayment($request->input('object.id'));
        }

        return response()->json(['status' => 'success']);
    }

    // Обработка успешного платежа
    protected function handleSuccessfulPayment($paymentId, $status, $metadata)
    {
        // Здесь обновляем статус заказа в базе данных
        // Например:
        // Order::where('payment_id', $paymentId)->update(['status' => 'paid']);

        Log::info("Payment {$paymentId} succeeded", [
            'status' => $status,
            'metadata' => $metadata
        ]);
    }

    // Обработка отмененного платежа
    protected function handleCanceledPayment($paymentId)
    {
        // Обновляем статус заказа на "отменен"
        Log::info("Payment {$paymentId} canceled");
    }

    public function success()
    {
        return view('payment.success');
    }

    public function failure()
    {
        return view('payment.failure');
    }
}
