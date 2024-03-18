<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', 'paypal\ProcessController@ipn')->name('paypal');
    Route::get('paypal_sdk', 'paypal_sdk\ProcessController@ipn')->name('paypal_sdk');
    Route::post('perfect_money', 'perfect_money\ProcessController@ipn')->name('perfect_money');
    Route::post('stripe', 'stripe\ProcessController@ipn')->name('stripe');
    Route::post('stripe_js', 'stripe_js\ProcessController@ipn')->name('stripe_js');
    Route::post('stripe_v3', 'stripe_v3\ProcessController@ipn')->name('stripe_v3');
    Route::post('skrill', 'skrill\ProcessController@ipn')->name('skrill');
    Route::post('paytm', 'paytm\ProcessController@ipn')->name('paytm');
    Route::post('payeer', 'payeer\ProcessController@ipn')->name('payeer');
    Route::post('paystack', 'paystack\ProcessController@ipn')->name('paystack');
    Route::post('voguepay', 'voguepay\ProcessController@ipn')->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', 'flutterwave\ProcessController@ipn')->name('flutterwave');
    Route::post('razorpay', 'razorpay\ProcessController@ipn')->name('razorpay');
    Route::post('instamojo', 'instamojo\ProcessController@ipn')->name('instamojo');
    Route::get('blockchain', 'blockchain\ProcessController@ipn')->name('blockchain');
    Route::get('blockio', 'blockio\ProcessController@ipn')->name('blockio');
    Route::post('coinpayments', 'coinpayments\ProcessController@ipn')->name('coinpayments');
    Route::post('coinpayments_fiat', 'coinpayments_fiat\ProcessController@ipn')->name('coinpayments_fiat');
    Route::post('coingate', 'coingate\ProcessController@ipn')->name('coingate');
    Route::post('coinbase_commerce', 'coinbase_commerce\ProcessController@ipn')->name('coinbase_commerce');
    Route::get('mollie', 'mollie\ProcessController@ipn')->name('mollie');
    Route::post('cashmaal', 'cashmaal\ProcessController@ipn')->name('cashmaal');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', 'TicketController@supportTicket')->name('ticket');
    Route::get('/new', 'TicketController@openSupportTicket')->name('ticket.open');
    Route::post('/create', 'TicketController@storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'TicketController@viewTicket')->name('ticket.view');
    Route::put('/reply/{ticket}', 'TicketController@replyTicket')->name('ticket.reply');
    Route::get('/download/{ticket}', 'TicketController@ticketDownload')->name('ticket.download');
});


/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {



    Route::get('kyc-setting', 'KycController@setting')->name('kyc.setting');
    Route::post('kyc-setting', 'KycController@settingUpdate');



    


    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');


    });


    Route::get('maintenance-mode', 'GeneralSettingController@maintenanceMode')->name('maintenance.mode');

    Route::middleware('admin')->group(function () {

            Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
            Route::get('profile', 'AdminController@profile')->name('profile');
            Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
            Route::get('password', 'AdminController@password')->name('password');
            Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

            Route::get('download-attachments/{file_hash}', 'AdminController@downloadAttachment')->name('download.attachment');



            //Notification Setting
            Route::name('setting.notification.')->prefix('notification')->group(function () {
                //Template Setting
                Route::get('global', 'NotificationController@global')->name('global');
                Route::post('global/update', 'NotificationController@globalUpdate')->name('global.update');
                Route::get('templates', 'NotificationController@templates')->name('templates');
                Route::get('template/edit/{id}', 'NotificationController@templateEdit')->name('template.edit');
                Route::post('template/update/{id}', 'NotificationController@templateUpdate')->name('template.update');

                //Email Setting
                Route::get('email/setting', 'NotificationController@emailSetting')->name('email');
                Route::post('email/setting', 'NotificationController@emailSettingUpdate');
                Route::post('email/test', 'NotificationController@emailTest')->name('email.test');

                //SMS Setting
                Route::get('sms/setting', 'NotificationController@smsSetting')->name('sms');
                Route::post('sms/setting', 'NotificationController@smsSettingUpdate');
                Route::post('sms/test', 'NotificationController@smsTest')->name('sms.test');
                
                
                 //push setting
                Route::get('push/setting', 'NotificationController@pushSetting')->name('push.setting');
                Route::post('push/setting', 'NotificationController@pushSettingUpdate')->name('push.setting.submit');
                
                
            });


            //Notification
            Route::get('notifications', 'AdminController@notifications')->name('notifications');
            Route::get('notification/read/{id}', 'AdminController@notificationRead')->name('notification.read');
            Route::get('notifications/read-all', 'AdminController@readAll')->name('notifications.readAll');

            // Manage Currency
            Route::get('currency/all', 'CurrencyController@showAll')->name('currency');
            Route::get('currency/create', 'CurrencyController@create')->name('currency.create');
            Route::post('currency/create', 'CurrencyController@currencyAdd');
            Route::get('currency/edit/{currency}/{slug}', 'CurrencyController@editCurrency')->name('currency.edit');
            Route::post('currency/edit/{currency}/{slug}', 'CurrencyController@currencyUpdate');
            Route::get('currency/search', 'CurrencyController@currencysearch')->name('currency.search');
            Route::get('currency/ajax', 'CurrencyController@currencyAjax')->name('currency.ajax');

            // Exchange 

            Route::get('exchange/all', 'ExchangeController@index')->name('exchange.all');
            Route::get('exchange/details/{exchange}', 'ExchangeController@details')->name('exchange.details');
            Route::post('exchange/cancel/{exchange}', 'ExchangeController@cancle')->name('exchange.cancle');
            Route::post('exchange/approved/{exchange}', 'ExchangeController@approved')->name('exchange.approved');
            Route::post('exchange/refund/{exchange}', 'ExchangeController@refund')->name('exchange.refund');

            Route::get('exchange/approved', 'ExchangeController@approvedExchange')->name('exchange.total.approve');
            Route::get('exchange/pending', 'ExchangeController@pendingExchange')->name('exchange.total.pending');
            Route::get('exchange/proccessing', 'ExchangeController@proccessingExchange')->name('exchange.total.proccessing');
            Route::get('exchange/refunded', 'ExchangeController@refundedExchange')->name('exchange.total.refund');
            Route::get('exchange/cancel', 'ExchangeController@canceledExchange')->name('exchange.total.cancel');
            Route::get('exchange/search', 'ExchangeController@search')->name('exchange.search');

            // Refferal
            Route::get('refferal', 'RefferalController@refferal')->name('refferal');
            Route::post('refferal', 'RefferalController@refferalAdd');
            Route::get('reffer/user/{user}', 'AdminController@refferUser')->name('reffer.user');


            //Cookie
            Route::get('cookie', 'GeneralSettingController@cookie')->name('setting.cookie');
            Route::post('cookie', 'GeneralSettingController@cookieSubmit');

            //configuration
            Route::get('setting/system-configuration', 'GeneralSettingController@systemConfiguration')->name('setting.system.configuration');
            Route::post('setting/system-configuration', 'GeneralSettingController@systemConfigurationSubmit');

            //socialite credentials
            Route::get('setting/social/credentials', 'GeneralSettingController@socialiteCredentials')->name('setting.socialite.credentials');
            Route::post('setting/social/credentials/update/{key}', 'GeneralSettingController@updateSocialiteCredential')->name('setting.socialite.credentials.update');
            Route::post('setting/social/credentials/status/{key}', 'GeneralSettingController@updateSocialiteCredentialStatus')->name('setting.socialite.credentials.status.update');
            
            // Users Manager
            Route::get('users', 'ManageUsersController@allUsers')->name('users.all');
            Route::get('users/active', 'ManageUsersController@activeUsers')->name('users.active');
            Route::get('users/banned', 'ManageUsersController@bannedUsers')->name('users.banned');
            Route::get('users/email-verified', 'ManageUsersController@emailVerifiedUsers')->name('users.emailVerified');
            Route::get('users/email-unverified', 'ManageUsersController@emailUnverifiedUsers')->name('users.emailUnverified');
            Route::get('users/sms-unverified', 'ManageUsersController@smsUnverifiedUsers')->name('users.smsUnverified');
            Route::get('users/sms-verified', 'ManageUsersController@smsVerifiedUsers')->name('users.smsVerified');

            Route::get('send-notification/{id}', 'ManageUsersController@showNotificationSingleForm')->name('users.notification.single');
            Route::post('send-notification/{id}', 'ManageUsersController@sendNotificationSingle')->name('users.notification.single');
             Route::get('login/{id}', 'ManageUsersController@login')->name('users.login');
            Route::post('status/{id}', 'ManageUsersController@status')->name('users.status');

            Route::get('send-notification', 'ManageUsersController@showNotificationAllForm')->name('users.notification.all');
            Route::post('send-notification', 'ManageUsersController@sendNotificationAll')->name('users.notification.all.send');
            Route::get('notification-log/{id}', 'ManageUsersController@notificationLog')->name('users.notification.log');



            Route::get('users/kyc-unverified', 'ManageUsersController@kycUnverifiedUsers')->name('users.kyc.unverified');
            Route::get('users/kyc-pending', 'ManageUsersController@kycPendingUsers')->name('users.kyc.pending');
            Route::get('users/kyc-data/{id}', 'ManageUsersController@kycDetails')->name('users.kyc.details');
            Route::post('users/kyc-approve/{id}', 'ManageUsersController@kycApprove')->name('users.kyc.approve');
            Route::post('users/kyc-reject/{id}', 'ManageUsersController@kycReject')->name('users.kyc.reject');

            Route::get('users/{scope}/search', 'ManageUsersController@search')->name('users.search');
            Route::get('user/detail/{id}', 'ManageUsersController@detail')->name('users.detail');
            Route::post('user/update/{id}', 'ManageUsersController@update')->name('users.update');
            Route::post('user/add-sub-balance/{id}', 'ManageUsersController@addSubBalance')->name('users.addSubBalance');
            Route::get('user/transactions/{id}', 'ManageUsersController@transactions')->name('users.transactions');
            Route::get('user/deposits/{id}', 'ManageUsersController@deposits')->name('users.deposits');
            Route::get('user/deposits/via/{method}/{type?}/{userId}', 'ManageUsersController@depViaMethod')->name('users.deposits.method');
            Route::get('user/withdrawals/{id}', 'ManageUsersController@withdrawals')->name('users.withdrawals');
            // Login History
            Route::get('users/login/history/{id}', 'ManageUsersController@userLoginHistory')->name('users.login.history.single');

            // Subscriber
            Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
            Route::get('subscriber/send-email', 'SubscriberController@sendEmailForm')->name('subscriber.sendEmail');
            Route::post('subscriber/remove', 'SubscriberController@remove')->name('subscriber.remove');
            Route::post('subscriber/send-email', 'SubscriberController@sendEmail')->name('subscriber.sendEmail');





            // Deposit Gateway
            Route::name('gateway.')->prefix('gateway')->group(function(){
                // Automatic Gateway
                Route::get('automatic', 'GatewayController@index')->name('automatic.index');
                Route::get('automatic/edit/{alias}', 'GatewayController@edit')->name('automatic.edit');
                Route::post('automatic/update/{code}', 'GatewayController@update')->name('automatic.update');
                Route::post('automatic/remove/{code}', 'GatewayController@remove')->name('automatic.remove');
                Route::post('automatic/activate', 'GatewayController@activate')->name('automatic.activate');
                Route::post('automatic/deactivate', 'GatewayController@deactivate')->name('automatic.deactivate');
            });


            // WITHDRAW SYSTEM
            Route::name('withdraw.')->prefix('withdraw')->group(function () {
                Route::get('pending', 'WithdrawalController@pending')->name('pending');
                Route::get('approved', 'WithdrawalController@approved')->name('approved');
                Route::get('rejected', 'WithdrawalController@rejected')->name('rejected');
                Route::get('log', 'WithdrawalController@log')->name('log');
                Route::get('{scope}/search', 'WithdrawalController@search')->name('search');
                Route::get('details/{id}', 'WithdrawalController@details')->name('details');
                Route::post('approve', 'WithdrawalController@approve')->name('approve');
                Route::post('reject', 'WithdrawalController@reject')->name('reject');
            });

            // Report
            Route::get('report/transaction', 'ReportController@transaction')->name('report.transaction');
            Route::get('report/transaction/search', 'ReportController@transactionSearch')->name('report.transaction.search');
            Route::get('report/login/history', 'ReportController@loginHistory')->name('report.login.history');
            Route::get('report/login/ipHistory/{ip}', 'ReportController@loginIpHistory')->name('report.login.ipHistory');
            Route::get('referral/commission', 'ReportController@referralCommission')->name('report.referral.commission');
            Route::get('notification/history', 'ReportController@notificationHistory')->name('report.notification.history');
            Route::get('email/detail/{id}', 'ReportController@emailDetails')->name('report.email.details');

            // Admin Support
            Route::get('tickets', 'SupportTicketController@tickets')->name('ticket');
            Route::get('tickets/pending', 'SupportTicketController@pendingTicket')->name('ticket.pending');
            Route::get('tickets/closed', 'SupportTicketController@closedTicket')->name('ticket.closed');
            Route::get('tickets/answered', 'SupportTicketController@answeredTicket')->name('ticket.answered');
            Route::get('tickets/view/{id}', 'SupportTicketController@ticketReply')->name('ticket.view');
            Route::post('ticket/reply/{id}', 'SupportTicketController@ticketReplySend')->name('ticket.reply');
            Route::get('ticket/download/{ticket}', 'SupportTicketController@ticketDownload')->name('ticket.download');
            Route::post('ticket/delete', 'SupportTicketController@ticketDelete')->name('ticket.delete');


            // Language Manager
            Route::get('/language', 'LanguageController@langManage')->name('language.manage');
            Route::post('/language', 'LanguageController@langStore')->name('language.manage.store');
            Route::post('/language/delete/{id}', 'LanguageController@langDel')->name('language.manage.del');
            Route::post('/language/update/{id}', 'LanguageController@langUpdatepp')->name('language.manage.update');
            Route::get('/language/edit/{id}', 'LanguageController@langEdit')->name('language.key');
            Route::post('/language/import', 'LanguageController@langImport')->name('language.import_lang');



            Route::post('language/store/key/{id}', 'LanguageController@storeLanguageJson')->name('language.store.key');
            Route::post('language/delete/key/{id}', 'LanguageController@deleteLanguageJson')->name('language.delete.key');
            Route::post('language/update/key/{id}', 'LanguageController@updateLanguageJson')->name('language.update.key');



            // General Setting
            Route::get('general-setting', 'GeneralSettingController@index')->name('setting.index');
            Route::post('general-setting', 'GeneralSettingController@update')->name('setting.update');


            //maintenance_mode
            Route::get('maintenance-mode', 'GeneralSettingController@maintenanceMode')->name('maintenance.mode');
            Route::post('maintenance-mode', 'GeneralSettingController@maintenanceModeSubmit');


            // Logo-Icon
            Route::get('setting/logo-icon', 'GeneralSettingController@logoIcon')->name('setting.logo_icon');
            Route::post('setting/logo-icon', 'GeneralSettingController@logoIconUpdate')->name('setting.logo_icon');


            // Plugin
            Route::get('extensions', 'ExtensionController@index')->name('extensions.index');
            Route::post('extensions/update/{id}', 'ExtensionController@update')->name('extensions.update');
            Route::post('extensions/activate', 'ExtensionController@activate')->name('extensions.activate');
            Route::post('extensions/deactivate', 'ExtensionController@deactivate')->name('extensions.deactivate');


            // Email Setting
            Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
            Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
            Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
            Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
            Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
            Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
            Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
            Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.sendTestMail');


            // SMS Setting
            Route::get('sms-template/global', 'SmsTemplateController@smsSetting')->name('sms.template.global');
            Route::post('sms-template/global', 'SmsTemplateController@smsSettingUpdate')->name('sms.template.global');
            Route::get('sms-template/index', 'SmsTemplateController@index')->name('sms.template.index');
            Route::get('sms-template/edit/{id}', 'SmsTemplateController@edit')->name('sms.template.edit');
            Route::post('sms-template/update/{id}', 'SmsTemplateController@update')->name('sms.template.update');
            Route::post('email-template/send-test-sms', 'SmsTemplateController@sendTestSMS')->name('sms.template.sendTestSMS');

            // SEO
            Route::get('seo', 'FrontendController@seoEdit')->name('seo');


            // Frontend
            Route::name('frontend.')->prefix('frontend')->group(function () {


                Route::get('templates', 'FrontendController@templates')->name('templates');
                Route::post('templates', 'FrontendController@templatesActive')->name('templates.active');



                Route::get('frontend-sections/{key}', 'FrontendController@frontendSections')->name('sections');
                Route::post('frontend-content/{key}', 'FrontendController@frontendContent')->name('sections.content');
                Route::get('frontend-element/{key}/{id?}', 'FrontendController@frontendElement')->name('sections.element');
                Route::post('remove', 'FrontendController@remove')->name('remove');

                // Page Builder
                Route::get('manage-pages', 'PageBuilderController@managePages')->name('manage.pages');
                Route::post('manage-pages', 'PageBuilderController@managePagesSave')->name('manage.pages.save');
                Route::post('manage-pages/update', 'PageBuilderController@managePagesUpdate')->name('manage.pages.update');
                Route::post('manage-pages/delete', 'PageBuilderController@managePagesDelete')->name('manage.pages.delete');
                Route::get('manage-section/{id}', 'PageBuilderController@manageSection')->name('manage.section');
                Route::post('manage-section/{id}', 'PageBuilderController@manageSectionUpdate')->name('manage.section.update');
            });

            Route::get('blocked-ip', 'BlockedIpController@blockedIpList')->name('blocked.ip');
            Route::post('blocked-ip/insert', 'BlockedIpController@blockedIpInsert')->name('blocked.ip.submit');
            Route::post('blocked-ip/unblock', 'BlockedIpController@blockedIpDelete')->name('blocked.ip.delete');
    });
});


/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/

Route::name('user.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->middleware('regStatus');
    Route::post('check-mail', 'RegisterController@checkUser')->name('checkUser');


    Route::get('social-login/{provider}', 'Auth\SocialiteController@socialLogin')->name('social.login');
    Route::get('social-login/callback/{provider}', 'Auth\SocialiteController@callback')->name('social.login.callback');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('register/{reference}', 'Auth\RegisterController@referralRegister')->name('refer.register');
    });
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/code-verify', 'Auth\ForgotPasswordController@codeVerify')->name('password.code_verify');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/verify-code', 'Auth\ForgotPasswordController@verifyCode')->name('password.verify-code');
});

Route::name('user.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', 'AuthorizationController@authorizeForm')->name('authorization');
        Route::get('resend-verify', 'AuthorizationController@sendVerifyCode')->name('send_verify_code');
        Route::post('verify-email', 'AuthorizationController@emailVerification')->name('verify_email');
        Route::post('verify-sms', 'AuthorizationController@smsVerification')->name('verify_sms');
        Route::post('verify-g2fa', 'AuthorizationController@g2faVerification')->name('go2fa.verify');
        

        Route::get('user-data', 'UserController@userData')->name('data');

        Route::middleware('checkStatus')->group(function () {
            Route::get('user-data', 'UserController@userData')->name('data');
            Route::post('user-data-submit', 'UserController@userDataSubmit')->name('data.submit');
        });

        Route::middleware(['checkStatus','registration.complete'])->group(function () {
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



            Route::get('kyc-form', 'UserController@kycForm')->name('kyc.form');
            Route::get('kyc-data', 'UserController@kycData')->name('kyc.data');
            Route::post('kyc-submit', 'UserController@kycSubmit')->name('kyc.submit');
            Route::get('attachment-download/{fil_hash}', 'UserController@attachmentDownload')->name('attachment.download');


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
            Route::get('withdraw/log', 'UserController@withdrawLog')->name('withdraw.history')->withoutMiddleware('kyc');
            Route::get('withdraw/ajax/{currency}', 'UserController@withdrawAjax')->name('withdraw.ajax');
            Route::get('withdraw/amount', 'UserController@withdrawAjaxInput')->name('withdraw.ajax.amount');

            Route::get('withdraw/details/{trx}', 'UserController@withdrawDetails')->name('withdraw.details');


            Route::get('deposit/confirm', 'Gateway\PaymentController@depositConfirm')->name('deposit.confirm');


        });
    });
});



Route::post('exchange', 'UserController@exchange')->name('user.exchange');

Route::get('/contact', 'SiteController@contact')->name('contact');
Route::post('/contact', 'SiteController@contactSubmit')->name('contact.send');
Route::get('/change/{lang?}', 'SiteController@changeLanguage')->name('lang');

Route::get('policy/{id}/{slug}','SiteController@policy')->name('policy');
Route::get('blog', 'SiteController@blog')->name('blog');
Route::get('blog/{id}/{slug}', 'SiteController@blogDetails')->name('blog.details');
Route::get('blog/search', 'SiteController@blogSearch')->name('blog.search');

Route::get('cookie-policy', 'SiteController@cookiePolicy')->name('cookie.policy');

Route::get('/cookie/accept', 'SiteController@cookieAccept')->name('cookie.accept');

Route::get('placeholder-image/{size}', 'SiteController@placeholderImage')->name('placeholder.image');

Route::get('more', 'SiteController@loadMore')->name('load');

Route::get('/', 'SiteController@index')->name('home');
Route::get('/{slug}', 'SiteController@pages')->name('pages');

Route::post('subscribe', 'SiteController@subscribe')->name('subscribe');

Route::get('ajax/code', 'UserController@ajaxCode');
