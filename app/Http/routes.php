<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('hhhh',function(){
    return view('restaurant.upload');
});
Route::get('aaa', function () {
    dd(bcrypt('user123456'));
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/facebook', 'Auth\FacebookLoginController@redirectToProvider');
Route::post('/auth/facebook/getEmial', 'Auth\FacebookLoginController@getEmail');
Route::get('auth/facebook/callback', 'Auth\FacebookLoginController@handleProviderCallback');

Route::get('auth/google', 'Auth\GoogleLoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\GoogleLoginController@handleProviderCallback');

Route::get('admin/login', 'Auth\AuthController@showAdminLoginForm' );
Route::get('admin/register', 'Admin\RegisterController@showRegistrationForm' );
Route::post('admin/register', 'Admin\RegisterController@register' );

Route::post('logout','Auth\AuthController@logout');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('user/contact-details','UserController@getContactDetalis');
Route::post('user/contact-details','UserController@postContactDetalis');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){

    Route::get('/home', 'AdminController@index');
    Route::get('/', 'AdminController@index');

    Route::get('/users/blocked','UsersController@blockedUsers');
    Route::get('/users/block/{id}','UsersController@block');
    Route::get('/users/activate/{id}','UsersController@activate');
    Route::resource('users', 'UsersController');

    Route::get('/restaurants/blocked','RestaurantsController@blockedRestaurants');
    Route::get('/restaurants/block/{id}','RestaurantsController@block');
    Route::get('/restaurants/activate/{id}','RestaurantsController@activate');
    Route::resource('restaurants', 'RestaurantsController');

    Route::get('/cinemas/blocked','CinemasController@blockedCinemas');
    Route::get('/cinemas/block/{id}','CinemasController@block');
    Route::get('/cinemas/activate/{id}','CinemasController@activate');
    Route::resource('cinemas', 'CinemasController');

    Route::get('/admins/blocked','AdminsController@blockedAdmins');
    Route::get('/admins/block/{id}','AdminsController@block');
    Route::get('/admins/activate/{id}','AdminsController@activate');
    Route::resource('admins', 'AdminsController');


    Route::resource('kitchens', 'KitchensController');

});

Route::group(['prefix' => 'admin/restaurant', 'namespace' => 'Admin\Restaurant'], function(){

    Route::get('contact-details', 'RestaurantController@getContactDetails');
    Route::post('contact-details', 'RestaurantController@postContactDetails');

    Route::get('location', 'RestaurantController@getLocation');
    Route::post('location/getCity', 'RestaurantController@getCity' );
    Route::post('location', 'RestaurantController@postLocation' );

    Route::get('images','RestaurantController@getImages');
    Route::post('avatar','RestaurantController@changeAvatar');
    Route::post('images/add','RestaurantController@addImage');
    Route::get('image/remove/{id}','RestaurantController@removeImage');

    Route::get('parking-details','RestaurantController@parkingDetails');
    Route::post('parking-details/edit/{id}','RestaurantController@editParkingDetails');
    Route::get('parking-details/create','RestaurantController@getCreateParkingDetails');
    Route::post('parking-details/create','RestaurantController@postCreateParkingDetails');
    Route::get('parking-details/delete/{id}','RestaurantController@deleteParkingDetails');

    Route::resource('offers', 'OffersController');

    Route::resource('kitchens', 'KitchensController');

    Route::resource('tables', 'TablesController');

    Route::resource('bookings', 'BookingsController',['except' => ['create','store','destroy']]);
});





