<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) { 
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1', 'prefix' => 'v1'], function ($api) {
        $api->post('login', 'LoginController@login');
        $api->post('register', 'LoginController@register');
        // $api->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        // $api->post('password/reset', 'ResetPasswordController@reset');
        $api->post('password/forgot', 'ForgotPasswordController@autoGeneratePassword');

        
        $api->get('get-ride', 'RideController@index');
        $api->get('get-ride/{id}', 'RideController@getride');
         // $api->post('ticket', 'TicketController@index');

        $api->group(['middleware' => 'jwt.verify'], function ($api_child) {

            $api_child->get('get-home', 'HomeController@index');
            $api_child->post('otp-verify', 'LoginController@otpVerify');
            $api_child->post('place-order', 'TicketController@index');
            $api_child->get('paymentHistory', 'LoginController@paymentHistory');

        });   
    });
});
