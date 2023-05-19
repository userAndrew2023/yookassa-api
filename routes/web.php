<?php

use Illuminate\Support\Facades\Route;
use YooKassa\Client;

Route::get('/create_payment', function () {
    $client = new Client();
    $client -> setAuth($_GET['login'], $_GET['password']);
    return $client -> createPayment(
        array(
            'amount' => array(
                'value' => $_GET['count'],
                'currency' => 'RUB'
            ),
            'confirmation' => array(
                'type' => 'redirect',
                'return_url' => $_GET['callback'],
            ),
            'capture' => true,
            'description' => 'Оплата из бота',
        ),
        uniqid('', true)
    )['confirmation']['confirmation_url'];
});

Route::get('/get_status/{id}', function ($id) {
    $client = new Client();
    $client -> setAuth('320062', 'test_Vfi3MBZSbXFSRm74KvDf2bN8mwLMW_ctUhEpmBMy_zI');
    return $client -> getPaymentInfo($id)['status'];
});


