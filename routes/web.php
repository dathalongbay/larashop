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

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
//Route::get('/home', 'HomeController@index');
Route::get('/search/{keyword}', 'Site\SiteController@searchPage')->name('site.search-result');
Route::post('/search', 'Site\SiteController@search')->name('site.search');
Route::post('/newsletter', 'Site\SiteController@newsletter')->name('site.newsletter');
Route::get('/newsletter', 'Site\SiteController@thankNewsletter')->name('site.thank_newsletter');

Route::post('/cart', 'Site\CartController@add');
Route::post('/cart-delete', 'Site\CartController@delete');
Route::post('/cart-update', 'Site\CartController@update');
Route::get('/cart-clear', 'Site\CartController@clear');

Route::get('/category/{id}', 'Site\SiteController@showCategory')->name('show-category');
Route::get('/product/{id}', 'Site\SiteController@showProduct')->name('show-product');
Route::get('/page/{id}', 'Site\SiteController@showPage')->name('show-page');
Route::get('/cart', 'Site\SiteController@showCart')->name('show-cart');
Route::get('/checkout', 'Site\SiteController@checkout')->name('checkout');
Route::post('/checkout', 'Site\SiteController@checkout_submit')->name('checkout.submit');
Route::get('/completed', 'Site\SiteController@completed')->name('completed');
Route::get('/contact', 'Site\SiteController@contact')->name('contact');

Route::prefix('administrator')->group(function() {


    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::put('/profile/{id}', 'AdminController@profileUpdate')->name('profile.update');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');


    // Admin
    //Route::get('/administrator', 'Admin\AdminController@index')->name('admin');

    Route::resource('/users', 'Admin\UserController');

    Route::resource('/roles', 'Admin\RoleController');

    Route::resource('/permissions', 'Admin\PermissionController');

    Route::resource('/posts', 'Admin\PostController');

    Route::resource('/banner', 'Admin\AdminBannerController');
    Route::resource('/newsletter', 'Admin\AdminNewsletterController');
    Route::resource('/order', 'Admin\AdminOrderController');

    Route::resource('/menus', 'Admin\AdminMenuController');
    Route::resource('/settings', 'Admin\AdminSettingController');



    Route::get('/menu-items/create/{menu}', 'Admin\AdminMenuItemsController@create')->name('menu-items.create');

    Route::post('/menu-items', 'Admin\AdminMenuItemsController@store');

    Route::get('/menu-items/edit/{id}', 'Admin\AdminMenuItemsController@edit');

    Route::put('/menu-items/{id}', 'Admin\AdminMenuItemsController@update')->name('menu-items.updatedata');

    Route::delete('/menu-items/{id}', 'Admin\AdminMenuItemsController@destroy')->name('menu-items.destroy');

    Route::get('/menu-items/{menu_id}', 'Admin\AdminMenuItemsController@index')->name('menu-items.index');

    Route::resource('/product', 'Admin\AdminProductController');

    Route::resource('/comment', 'Admin\AdminCommentController');
    Route::resource('/media', 'Admin\AdminMediaController');

    Route::resource('/page', 'Admin\AdminPageController');

    Route::resource('/product-category', 'Admin\AdminProductCategoryController');
});

// comment

