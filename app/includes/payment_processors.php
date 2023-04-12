<?php
/*
 * @copyright Copyright (c) 2021 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

return [
    'paypal' => [
        'payment_type' => ['one_time', 'recurring'],
        'icon' => 'fab fa-paypal',
        'color' => '#3b7bbf',
    ],
    'stripe' => [
        'payment_type' => ['one_time', 'recurring'],
        'icon' => 'fab fa-stripe',
        'color' => '#5433FF',
    ],
    'offline_payment' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-university',
        'color' => '#2f343c',
    ],
    'coinbase' => [
        'payment_type' => ['one_time'],
        'icon' => 'fab fa-bitcoin',
        'color' => '#0050FF',
    ],
    'payu' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-underline',
        'color' => '#A6C306',
    ],
    'paystack' => [
        'payment_type' => ['one_time', 'recurring'],
        'icon' => 'fa fa-money-check',
        'color' => '#00C3F7',
    ],
    'razorpay' => [
        'payment_type' => ['one_time', 'recurring'],
        'icon' => 'fa fa-heart',
        'color' => '#2b84ea',
    ],
    'mollie' => [
        'payment_type' => ['one_time', 'recurring'],
        'icon' => 'fa fa-shopping-basket',
        'color' => '#465975',
    ],
    'yookassa' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-ruble-sign',
        'color' => '#004CAA',
    ],
    'crypto_com' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-coins',
        'color' => '#21315C',
    ],
    'paddle' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-star',
        'color' => '#a6b0b9',
    ],
    'mercadopago' => [
        'payment_type' => ['one_time'],
        'icon' => 'fa fa-handshake',
        'color' => '#009EE3',
    ],
];
