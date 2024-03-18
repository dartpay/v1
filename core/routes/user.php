<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;

Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', 'UserController@home')->name('home');

            // Affiliation
            Route::get('affiliate', 'AffiliateController@affiliate')->name('affiliate');
            Route::post('affiliate', 'AffiliateController@affiliateSend');
            
            Route::get('profile-setting', 'UserController@profile')->name('profile-setting');
            Route::post('profile-setting', 'UserController@submitProfile');
            Route::get('change-password', 'UserController@changePassword')->name('change-password');
            Route::post('change-password', 'UserController@submitPassword');

            //2FA
            Route::get('twofactor', 'UserController@show2faForm')->name('twofactor');
            Route::post('twofactor/enable', 'UserController@create2fa')->name('twofactor.enable');
            Route::post('twofactor/disable', 'UserController@disable2fa')->name('twofactor.disable');


            // exchange

            Route::get('exchange/preview', 'UserController@exchangepreview')->name('exchange.preview');
            Route::post('exchange/preview', 'UserController@exchangeConfirm');
            Route::get('exchange/transaction', 'UserController@transactionConfirmByTrx')->name('exchange.trnx');
            Route::post('exchange/transaction', 'UserController@transactionConfirmByTrxAdd');
            Route::get('exchange/transaction/success', 'UserController@transactionSuccess')->name('transaction.success');
            Route::get('exchange/cancle', 'UserController@cancledExchange')->name('exchange.cancled');
            Route::get('exchange/pending', 'UserController@pendingExchange')->name('exchange.pending');
            Route::get('exchange/approved', 'UserController@approvedExchange')->name('exchange.approved');
            Route::get('exchange/refunded', 'UserController@refundedExchange')->name('exchange.refunded');
            Route::get('exchange/details/{exchange}', 'UserController@exchangeDetails')->name('exchange.details');
            Route::get('exchange/all', 'UserController@allExchange')->name('exchange.all');
            Route::get('exchange/proccessing', 'UserController@proccessingExchange')->name('exchange.proccessing');


            Route::get('reffer/log', 'UserController@refferLog')->name('reffer.log');

            Route::get('withdraw', 'UserController@withdrawForm')->name('withdraw');
            Route::post('withdraw', 'UserController@withdrawFormSubmit');
            Route::get('withdraw/preview', 'UserController@withdrawPreview')->name('withdraw.preview');
            Route::get('withdraw/log', 'UserController@withdrawLog')->name('withdraw.history');
            Route::get('withdraw/ajax/{currency}', 'UserController@withdrawAjax')->name('withdraw.ajax');
            Route::get('withdraw/amount', 'UserController@withdrawAjaxInput')->name('withdraw.ajax.amount');

            Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');


        });
    });
});
