<?php


Route::group(['domain' => 'admin.anp.hybrain.co', 'namespace' => 'Admins'], function () {

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.show-login-form');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.show-link-request-form');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.send-reset-link-email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.show-reset-form');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.reset');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'DashboardsController@index')->name('admin.home');
        Route::get('dashboard', 'DashboardsController@index')->name('admin.dashboard');

        // Create Admin Routes...
        Route::get('admins/create', 'Auth\RegisterController@showRegistrationForm')->name('admins.create');
        Route::post('admins', 'Auth\RegisterController@register')->name('admins.store');

        // Admin Routes
        Route::get('admins/profile', 'AdminsController@profile')->name('admins.profile');
        Route::get('admins/assign-role/{user}', 'AdminsController@showAssignRoleForm')->name('admins.show-assign-roles-form');
        Route::post('admins/toggle-role', 'AdminsController@toggleRole')->name('admins.toggle-role');
        Route::delete('admins/{admin}', 'AdminsController@destroy')->name('admins.destroy');
        Route::resource('admins', 'AdminsController', [
            'only' => [
                'index', 'show', 'update'
            ]
        ]);

        // ACL Routes
        Route::resource('roles', 'RolesController');
        Route::get('roles/assign-permissions/{role}', 'RolesController@showAssignPermissionForm')->name('roles.show-assign-permissions-form');
        Route::post('roles/toggle-permission', 'RolesController@togglePermission')->name('roles.toggle-permission');
        Route::resource('permissions', 'PermissionsController');

        // Categories Routes
        Route::resource('categories', 'CategoriesController');

        // Producers Routes
        Route::resource('producers', 'ProducersController');

        // Products Routes
        Route::post('products/{product}/image', 'ProductsController@addImage');
        Route::post('products/{product}/retail', 'ProductsController@addRetail');
        Route::resource('products', 'ProductsController');


        // Retail Sizes Rotes
        Route::get('retail/create', 'RetailSizesController@create')->name('admins.retailSizes.create');
        Route::post('retail', 'RetailSizesController@store')->name('admins.retailSizes.store');
        Route::get('retail', 'RetailSizesController@index')->name('admins.retailSizes.index');
        Route::get('retail/{retail}', 'RetailSizesController@show')->name('admins.retailSizes.show');
        Route::get('retail/{retail}/edit', 'RetailSizesController@edit')->name('admins.retailSizes.edit');
        Route::patch('retail/{retail}/update', 'RetailSizesController@update')->name('admins.retailSizes.update');
        Route::delete('retail/{retail}', 'RetailSizesController@destroy')->name('admins.retailSizes.destroy');


        // Orders Routes
        Route::get('orders/pending', 'OrdersController@index')->name('admins.orders.pending');
        Route::get('orders/confirmed', 'OrdersController@indexConfirmed')->name('admins.orders.confirmed');
        Route::get('orders/{order}', 'OrdersController@show')->name('admins.orders.show');
        Route::get('orders/{order}/edit', 'OrdersController@edit')->name('admins.orders.edit');
        Route::patch('orders/{order}/update', 'OrdersController@update')->name('admins.orders.update');
        Route::get('orders/confirm/{order}', 'OrdersController@confirm')->name('admins.orders.confirm');
        Route::get('orders/cancel/{order}', 'OrdersController@cancel')->name('admins.orders.cancel');
        Route::get('orders/paid/{order}', 'OrdersController@paid')->name('admins.orders.paid');
        Route::get('orders/delivered/{order}', 'OrdersController@delivered')->name('admins.orders.delivered');

        // Messages Routes
        Route::get('messages', 'MessagesController@index')->name('admins.messages.index');
        Route::get('messages/{message}', 'MessagesController@show');

        //Customer Routes
        Route::get('customers', 'UsersController@index')->name('admins.users.index');
        Route::get('customers/{customer}', 'UsersController@show')->name('admins.users.show');
        Route::get('customers/{customer}/orders', 'UsersController@showOrders')->name('admins.users.showOrders');
    });
});

Route::group(['domain' => 'anp.hybrain.co', 'namespace' => 'Users'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('show-login-form');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('show-registration-form');
    Route::post('register', 'Auth\RegisterController@register')->name('register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('show-link-request-form');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('send-reset-link-email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('show-reset-form');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset');

    // Pages
    Route::get('/', 'PagesController@index')->name('home');
    Route::get('instructions','PagesController@instructions')->name('instructions');
    Route::get('producers','PagesController@producers')->name('producers');
    Route::get('contact-us', 'PagesController@contactUs')->name('contact-us');
    Route::post('contact-us', 'PagesController@send');
    Route::get('about-us', 'PagesController@aboutUs')->name('about-us');

    // Shop
    Route::get('shop', 'ShopsController@index')->name('shop');
    Route::get('shop/{shop}', 'ShopsController@show')->name('shop.show');

    // Dashboards
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', 'DashboardsController@index')->name('dashboard');

        // Shopping cart
        Route::group(['prefix' => 'shopping-cart'], function () {
            Route::get('/', 'ShoppingCartsController@index')->name('shopping-cart');
            Route::get('/cart-items', 'ShoppingCartsController@showCartItems')->name('carts.items');
            /*Route::get('checkout', 'ShoppingCartsController@checkout')->name('checkout');*/
            Route::post('add-to-cart', 'ShoppingCartsController@addToCart')->name('carts.add-to-cart');
            Route::get('add-to-cart', 'ShopsController@index')->name('shop');
            Route::post('remove-from-cart', 'ShoppingCartsController@removeFromCart')->name('carts.remove-from-cart');
            // Route::post('add-quantity', 'ShoppingCartsController@addQuantity')->name('carts.add-quantity');
            // Route::post('subtract-quantity', 'ShoppingCartsController@subtractQuantity')->name('carts.subtract-quantity');
        });

        // Orders
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrdersController@index')->name('orders.index');
            Route::post('order', 'OrdersController@order')->name('orders.order');
            Route::get('/{order}', 'OrdersController@show');
            Route::post('/{order}', 'OrdersController@cancelOrder');
        });
    });

    //Paul's layout
    Route::get('/v2', 'PagesController@index')->name('home-v2');
    Route::get('/v2/shop', 'ShopsController@indexV2')->name('shop-v2');
});
