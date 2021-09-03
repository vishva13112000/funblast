<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::group(['prefix' => 'shopcategory'], function () {
    Route::get('/index', 'AdminAuth\ShopCategoryController@index')->name('shopcategory.index');
    Route::get('/create', 'AdminAuth\ShopCategoryController@create')->name('shopcategory.create');
    Route::post('/store', 'AdminAuth\ShopCategoryController@store')->name('shopcategory.store');
    Route::get('/edit/{id}', 'AdminAuth\ShopCategoryController@edit')->name('shopcategory.edit');
    Route::post('/update', 'AdminAuth\ShopCategoryController@update')->name('shopcategory.update');
    Route::post('/delete', 'AdminAuth\ShopCategoryController@delete')->name('shopcategory.delete');
    Route::any('/unassigned', 'AdminAuth\ShopCategoryController@unassigned')->name('shopcategory.unassigned');
    Route::any('/assign', 'AdminAuth\ShopCategoryController@assign')->name('shopcategory.assign');
});

Route::group(['prefix' => 'country'], function () {
    Route::get('/index', 'AdminAuth\CountryController@index')->name('country.index');
    Route::get('/create', 'AdminAuth\CountryController@create')->name('country.create');
    Route::post('/store', 'AdminAuth\CountryController@store')->name('country.store');
    Route::get('/edit/{id}', 'AdminAuth\CountryController@edit')->name('country.edit');
    Route::post('/update', 'AdminAuth\CountryController@update')->name('country.update');
    Route::post('/delete', 'AdminAuth\CountryController@delete')->name('country.delete');
      });

Route::group(['prefix' => 'state'], function () {
    Route::get('/index/{id}', 'AdminAuth\StateController@index')->name('state.index');
    Route::get('/select', 'AdminAuth\StateController@select')->name('state.select');
    Route::get('/create/{id}', 'AdminAuth\StateController@create')->name('state.create');
    Route::post('/store', 'AdminAuth\StateController@store')->name('state.store');
    Route::get('/edit/{id}', 'AdminAuth\StateController@edit')->name('state.edit');
    Route::post('/update', 'AdminAuth\StateController@update')->name('state.update');
    Route::post('/delete', 'AdminAuth\StateController@delete')->name('state.delete');
      });

Route::group(['prefix' => 'city'], function () {
    Route::get('/index/{id}', 'AdminAuth\CityController@index')->name('city.index');
    Route::get('/create/{id}', 'AdminAuth\CityController@create')->name('city.create');
    Route::post('/store', 'AdminAuth\CityController@store')->name('city.store');
    Route::get('/edit/{id}', 'AdminAuth\CityController@edit')->name('city.edit');
    Route::post('/update', 'AdminAuth\CityController@update')->name('city.update');
    Route::post('/delete', 'AdminAuth\CityController@delete')->name('city.delete');
    Route::get('/select', 'AdminAuth\CityController@select')->name('city.select');

});

//Shops
Route::group(['prefix' => 'shops'], function () {
    Route::get('/index', 'AdminAuth\ShopController@index')->name('shops.index');
    Route::get('/create', 'AdminAuth\ShopController@create')->name('shops.create');
    Route::post('/store', 'AdminAuth\ShopController@store')->name('shops.store');
    Route::get('/edit/{id}', 'AdminAuth\ShopController@edit')->name('shops.edit');
    Route::get('/show/{id}', 'AdminAuth\ShopController@show')->name('shops.show');
    Route::post('/update', 'AdminAuth\ShopController@update')->name('shops.update');
    Route::post('/delete', 'AdminAuth\ShopController@delete')->name('shops.delete');
    Route::any('/unassigned', 'AdminAuth\ShopController@unassigned')->name('shops.unassigned');
    Route::any('/assign', 'AdminAuth\ShopController@assign')->name('shops.assign');
    Route::any('/verify', 'AdminAuth\ShopController@verify')->name('shops.verify');
    Route::any('/unverify', 'AdminAuth\ShopController@unverify')->name('shops.unverify');
//    Route::get('/subscription/{id}', 'AdminAuth\ShopController@subscription')->name('shops.subscription');
//    Route::post('/createsubscription', 'AdminAuth\ShopController@createsubscription')->name('shops.createsubscription');
//    Route::get('/subscriptions', 'AdminAuth\ShopController@subscriptions')->name('shops.subscriptions');
});
//
////Category
Route::group(['prefix' => 'category'], function () {
    Route::get('/index', 'AdminAuth\CategoryController@index')->name('category.index');
    Route::get('/create', 'AdminAuth\CategoryController@create')->name('category.create');
    Route::post('/store', 'AdminAuth\CategoryController@store')->name('category.store');
    Route::get('/edit/{id}', 'AdminAuth\CategoryController@edit')->name('category.edit');
    Route::post('/update', 'AdminAuth\CategoryController@update')->name('category.update');
    Route::post('/delete', 'AdminAuth\CategoryController@delete')->name('category.delete');
    Route::any('/unassigned', 'AdminAuth\CategoryController@unassigned')->name('category.unassigned');
    Route::any('/assign', 'AdminAuth\CategoryController@assign')->name('category.assign');
});



Route::group(['prefix' => 'product'], function () {
    Route::get('/index', 'AdminAuth\ProductController@index')->name('product.index');
    Route::get('/create', 'AdminAuth\ProductController@create')->name('product.create');
    Route::post('/store', 'AdminAuth\ProductController@store')->name('product.store');
    Route::get('/edit/{id}', 'AdminAuth\ProductController@edit')->name('product.edit');
    Route::post('/update', 'AdminAuth\ProductController@update')->name('product.update');
    Route::post('/delete', 'AdminAuth\ProductController@delete')->name('product.delete');
    Route::any('/unassigned', 'AdminAuth\ProductController@unassigned')->name('product.unassigned');
    Route::any('/assign', 'AdminAuth\ProductController@assign')->name('product.assign');
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/index', 'AdminAuth\CustomerController@index')->name('customer.index');
    Route::get('/create', 'AdminAuth\CustomerController@create')->name('customer.create');
    Route::post('/store', 'AdminAuth\CustomerController@store')->name('customer.store');
    Route::get('/edit/{id}', 'AdminAuth\CustomerController@edit')->name('customer.edit');
    Route::post('/update', 'AdminAuth\CustomerController@update')->name('customer.update');
    Route::post('/delete', 'AdminAuth\CustomerController@delete')->name('customer.delete');
    Route::any('/unassigned', 'AdminAuth\CustomerController@unassigned')->name('customer.unassigned');
    Route::any('/assign', 'AdminAuth\CustomerController@assign')->name('customer.assign');
    Route::any('/money', 'AdminAuth\CustomerController@money')->name('customer.money');
        Route::get('/paymentHistory/{id}', 'AdminAuth\CustomerController@paymentHistory')->name('customer.paymentHistory');
});

Route::group(['prefix' => 'discount'], function () {
    Route::get('/index', 'AdminAuth\DiscountController@index')->name('discount.index');
    Route::get('/create', 'AdminAuth\DiscountController@create')->name('discount.create');
    Route::post('/store', 'AdminAuth\DiscountController@store')->name('discount.store');
    Route::get('/edit/{id}', 'AdminAuth\DiscountController@edit')->name('discount.edit');
    Route::post('/update', 'AdminAuth\DiscountController@update')->name('discount.update');
    Route::post('/delete', 'AdminAuth\DiscountController@delete')->name('discount.delete');
    Route::any('/unassigned', 'AdminAuth\DiscountController@unassigned')->name('discount.unassigned');
    Route::any('/assign', 'AdminAuth\DiscountController@assign')->name('discount.assign');
    // Route::any('/money', 'AdminAuth\CustomerController@money')->name('customer.money');
    //     Route::get('/paymentHistory/{id}', 'AdminAuth\CustomerController@paymentHistory')->name('customer.paymentHistory');
});


Route::group(['prefix' => 'branch'], function () {
    Route::get('/index', 'AdminAuth\BranchController@index')->name('branch.index');
    Route::get('/create', 'AdminAuth\BranchController@create')->name('branch.create');
    Route::post('/store', 'AdminAuth\BranchController@store')->name('branch.store');
    Route::get('/edit/{id}', 'AdminAuth\BranchController@edit')->name('branch.edit');
    Route::post('/update', 'AdminAuth\BranchController@update')->name('branch.update');
    Route::post('/delete', 'AdminAuth\BranchController@delete')->name('branch.delete');
    Route::any('/unassigned', 'AdminAuth\BranchController@unassigned')->name('branch.unassigned');
    Route::any('/assign', 'AdminAuth\BranchController@assign')->name('branch.assign');
   
});

Route::group(['prefix' => 'ride'], function () {
    Route::get('/index', 'AdminAuth\RideController@index')->name('ride.index');
    Route::get('/create', 'AdminAuth\RideController@create')->name('ride.create');
    Route::post('/store', 'AdminAuth\RideController@store')->name('ride.store');
    Route::get('/edit/{id}', 'AdminAuth\RideController@edit')->name('ride.edit');
    Route::post('/update', 'AdminAuth\RideController@update')->name('ride.update');
    Route::post('/delete', 'AdminAuth\RideController@delete')->name('ride.delete');
    Route::any('/unassigned', 'AdminAuth\RideController@unassigned')->name('ride.unassigned');
    Route::any('/assign', 'AdminAuth\RideController@assign')->name('ride.assign');
    Route::post('ride/scanqr','AdminAuth\RideController@scanqr')->name('scan.qr');
});

Route::group(['prefix' => 'payment'], function () {
    Route::get('/index', 'AdminAuth\PaymentController@index')->name('payment.index');
    Route::get('/create', 'AdminAuth\PaymentController@create')->name('payment.create');
    Route::post('/store', 'AdminAuth\PaymentController@store')->name('payment.store');
    Route::get('/edit/{id}', 'AdminAuth\PaymentController@edit')->name('payment.edit');
    Route::post('/update', 'AdminAuth\PaymentController@update')->name('payment.update');
    Route::post('/delete', 'AdminAuth\PaymentController@delete')->name('payment.delete');
    Route::any('/unassigned', 'AdminAuth\PaymentController@unassigned')->name('payment.unassigned');
    Route::any('/assign', 'AdminAuth\PaymentController@assign')->name('payment.assign');
     Route::any('/money', 'AdminAuth\PaymentController@money')->name('payment.money');
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('/index', 'AdminAuth\TicketController@index')->name('ticket.index');
    Route::get('/create', 'AdminAuth\TicketController@create')->name('ticket.create');
     Route::post('/store', 'AdminAuth\TicketController@store')->name('ticket.store');
     Route::get('/edit/{id}', 'AdminAuth\TicketController@edit')->name('ticket.edit');
     Route::post('/update', 'AdminAuth\TicketController@update')->name('ticket.update');
     Route::post('/delete', 'AdminAuth\TicketController@delete')->name('ticket.delete');
     Route::any('/unassigned', 'AdminAuth\TicketController@unassigned')->name('ticket.unassigned');
     Route::any('/assign', 'AdminAuth\TicketController@assign')->name('ticket.assign');
     Route::any('/money', 'AdminAuth\TicketController@money')->name('ticket.money');
     Route::any('/selectamount', 'AdminAuth\TicketController@selectamount')->name('ticket.selectamount');
});

Route::group(['prefix' => 'amount'], function () {
    Route::get('/index', 'AdminAuth\AmountController@index')->name('amount.index');
    Route::get('/create', 'AdminAuth\AmountController@create')->name('amount.create');
    Route::post('/store', 'AdminAuth\AmountController@store')->name('amount.store');
    Route::get('/edit/{id}', 'AdminAuth\AmountController@edit')->name('amount.edit');
    Route::post('/update', 'AdminAuth\AmountController@update')->name('amount.update');
    Route::post('/delete', 'AdminAuth\AmountController@delete')->name('amount.delete');
    Route::any('/unassigned', 'AdminAuth\AmountController@unassigned')->name('amount.unassigned');
    Route::any('/assign', 'AdminAuth\AmountController@assign')->name('amount.assign');
     Route::any('/money', 'AdminAuth\AmountController@money')->name('amount.money');
});

//
//
////Brand
//Route::group(['prefix' => 'brand'], function () {
//    Route::get('/index', 'AdminAuth\BrandController@index')->name('brand.index');
//    Route::get('/create', 'AdminAuth\BrandController@create')->name('brand.create');
//    Route::post('/store', 'AdminAuth\BrandController@store')->name('brand.store');
//    Route::get('/edit/{id}', 'AdminAuth\BrandController@edit')->name('brand.edit');
//    Route::post('/ubpdate', 'AdminAuth\BrandController@update')->name('brand.update');
//    Route::post('/delete', 'AdminAuth\BrandController@delete')->name('brand.delete');
//    Route::any('/unassigned', 'AdminAuth\BrandController@unassigned')->name('brand.unassigned');
//    Route::any('/assign', 'AdminAuth\BrandController@assign')->name('brand.assign');
//});
//
////Subscription
//Route::group(['prefix' => 'subscription'], function () {
//    Route::get('/index', 'AdminAuth\SubscriptionController@index')->name('subscription.index');
//    Route::get('/create', 'AdminAuth\SubscriptionController@create')->name('subscription.create');
//    Route::post('/store', 'AdminAuth\SubscriptionController@store')->name('subscription.store');
//    Route::get('/edit/{id}', 'AdminAuth\SubscriptionController@edit')->name('subscription.edit');
//    Route::post('/ubpdate', 'AdminAuth\SubscriptionController@update')->name('subscription.update');
//    Route::post('/delete', 'AdminAuth\SubscriptionController@delete')->name('subscription.delete');
//    Route::any('/unassigned', 'AdminAuth\SubscriptionController@unassigned')->name('subscription.unassigned');
//    Route::any('/assign', 'AdminAuth\SubscriptionController@assign')->name('subscription.assign');
//});
