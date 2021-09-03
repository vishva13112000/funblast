<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('branch')->user();

    //dd($users);

    return view('branch.home');
})->name('home');



Route::group(['prefix' => 'customer'], function () {
    Route::get('/index', 'BranchAuth\CustomerController@index')->name('customer.index');
    Route::get('/create', 'BranchAuth\CustomerController@create')->name('customer.create');
    Route::post('/store', 'BranchAuth\CustomerController@store')->name('customer.store');
    Route::get('/edit/{id}', 'BranchAuth\CustomerController@edit')->name('customer.edit');
    Route::post('/update', 'BranchAuth\CustomerController@update')->name('customer.update');
    Route::post('/delete', 'BranchAuth\CustomerController@delete')->name('customer.delete');
    Route::any('/unassigned', 'BranchAuth\CustomerController@unassigned')->name('customer.unassigned');
    Route::any('/assign', 'BranchAuth\CustomerController@assign')->name('customer.assign');
    Route::any('/money', 'BranchAuth\CustomerController@money')->name('customer.money');
        Route::get('/paymentHistory/{id}', 'BranchAuth\CustomerController@paymentHistory')->name('customer.paymentHistory');
});


Route::group(['prefix' => 'payment'], function () {
    Route::get('/index', 'BranchAuth\PaymentController@index')->name('payment.index');
    Route::get('/create', 'BranchAuth\PaymentController@create')->name('payment.create');
    Route::post('/store', 'BranchAuth\PaymentController@store')->name('payment.store');
    Route::get('/edit/{id}', 'BranchAuth\PaymentController@edit')->name('payment.edit');
    Route::post('/update', 'BranchAuth\PaymentController@update')->name('payment.update');
    Route::post('/delete', 'BranchAuth\PaymentController@delete')->name('payment.delete');
    Route::any('/unassigned', 'BranchAuth\PaymentController@unassigned')->name('payment.unassigned');
    Route::any('/assign', 'BranchAuth\PaymentController@assign')->name('payment.assign');
     Route::any('/money', 'BranchAuth\PaymentController@money')->name('payment.money');
});


