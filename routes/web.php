<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/test-mail', function () {
    Mail::raw('Teste de email', function ($message) {
        $message->to('christia10kk@gmail.com')
                ->subject('Teste Mailgun');
    });

    return 'Email enviado!';
});