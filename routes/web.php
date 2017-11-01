<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => 'admin.anp.app', 'namespace' => 'Admins'], function () {
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
        Route::get('/dashboard', 'DashboardsController@index')->name('admin.dashboard');

        // Create Admin Routes...
        Route::get('admins/create', 'Auth\RegisterController@showRegistrationForm')->name('admins.create');
        Route::post('admins', 'Auth\RegisterController@register')->name('admins.store');

        // Admin Routes
        Route::get('admins/profile', 'AdminsController@profile')->name('admins.profile');
        Route::patch('admins', 'AdminsController@update')->name('admins.update');
        Route::resource('admins', 'AdminsController', [
            'only' => [
                'index', 'destory'
            ]
        ]);

        // ACL Routes
        Route::get('/admins/assign-role/{user}', 'AdminsController@showAssignRoleForm')->name('admin.show-assign-roles-form');
        Route::post('/admins/toggle-role', 'AdminsController@toggleRole')->name('admin.toggle-role');
        Route::resource('roles', 'RolesController');
        Route::get('/roles/assign-permissions/{role}', 'RolesController@showAssignPermissionForm')->name('roles.show-assign-permissions-form');
        Route::post('/roles/toggle-permission', 'RolesController@togglePermission')->name('roles.toggle-permission');
        Route::resource('permissions', 'PermissionsController');

        // Categories Routes
        Route::resource('categories', 'CategoriesController');

        // Producers Routes
        Route::resource('producers', 'ProducersController');

        // Products Routes
        Route::resource('products', 'ProductsController');
    });
});

Route::group(['domain' => 'anp.app', 'namespace' => 'Users'], function () {
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

    Route::get('/', 'PagesController@index')->name('home');

    Route::group(['middleware' => 'auth'], function () {
    });
});
