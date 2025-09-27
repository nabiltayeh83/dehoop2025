<?php


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {

    
    Route::group(['namespace' => 'App\Http\Controllers\Site'], function () {
        Route::get('/', 'FrontController@index')->name('homePage');
        Route::get('aboutUs', 'FrontController@aboutUs')->name('aboutUs');
        Route::get('ourPartner', 'FrontController@ourPartner')->name('ourPartner');
        Route::get('ourBrands', 'FrontController@ourBrands')->name('ourBrands');
        Route::get('ourCollections', 'FrontController@ourCollections')->name('ourCollections');
        Route::get('collectionDet/{id}', 'FrontController@collectionDet')->name('collectionDet');
        Route::get('PartnerDet/{id}', 'FrontController@PartnerDet')->name('PartnerDet');
        Route::get('contactUs', 'FrontController@contactUs')->name('contactUs');
        Route::post('storeContactMsg', 'FrontController@storeContactMsg')->name('storeContactMsg');
        Route::post('storeMailList', 'FrontController@storeMailList')->name('storeMailList');
        Route::get('/notFound', 'FrontController@index')->name('notFound');
        

        
    });



    Route::group(['namespace' => 'App\Http\Controllers\Site' ,'middleware' => ['auth']], function () {
        Route::get('/logoutUsers', 'FrontController@logoutUsers')->name('logoutUsers'); 
    });







    Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\AdminAuth'], function () {
        Route::get('/', function () {
            return redirect()->route('admin.login.form');
        });
        
    
        
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'LoginController@login')->name('admin.login');
        Route::post('/logout', 'LoginController@logout')->name('admin.logout');

        // Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        // Route::post('/register', 'RegisterController@register');

        // Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.request');
        // Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.email');
        // Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
    });
    
    
    
    
            
    Route::group(['middleware' => ['web', 'admin', 'hasPermission'],  'prefix' => 'admin', 'as' => 'admin.',
        'namespace' => 'App\Http\Controllers\Admin'], function () {

        Route::get('/', function () {
            return redirect('admin/home');
        });


        Route::post('/changeStatus/{model}', 'HomeController@changeStatus');

        Route::get('home', 'HomeController@index')->name('admin.home');


        Route::get('/admins/{id}/edit_password', 'AdminController@edit_password')->name('admins.edit_password');
        Route::post('/admins/{id}/edit_password', 'AdminController@update_password')->name('admins.edit_password');
        Route::resource('/admins', 'AdminController');



        Route::resource('/Role', 'RoleController');
        Route::resource('/Brand', 'BrandController');

        Route::get('/Setting/notifications', 'SettingController@notifications')->name('Setting.notifications');
        Route::patch('/Setting/updateNotifications/{id}', 'SettingController@updateNotifications')->name('Setting.updateNotifications');
        
        
        Route::get('/Setting/main_page_content', 'SettingController@main_page_content')->name('Setting.main_page_content');
        Route::patch('/Setting/updateMainPageContent/{id}', 'SettingController@updateMainPageContent')->name('Setting.updateMainPageContent');
        
        
        
        Route::resource('/Setting', 'SettingController');
        
        Route::resource('/Page', 'PageController');
        Route::resource('/Contact', 'ContactController');
        Route::resource('/Partner', 'PartnerController');
        Route::resource('/Collection', 'CollectionController');
        Route::resource('/Slider', 'SliderController');


    });
    
    




});