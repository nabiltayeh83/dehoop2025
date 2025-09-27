<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



    Route::get('/privacyPolicy', 'App\Http\Controllers\API\AppController@privacyPolicy');
    Route::get('/termsAndConditions', 'App\Http\Controllers\API\AppController@termsAndConditions');
    
    Route::post('/signUpUsers', 'App\Http\Controllers\API\UserController@signUpUsers'); 
    Route::post('/checkCode', 'App\Http\Controllers\API\UserController@checkCode');  
    Route::post('/reSendCode', 'App\Http\Controllers\API\UserController@reSendCode'); 

    Route::post('/loginForUsers', 'App\Http\Controllers\API\UserController@loginForUsers'); 


    Route::get('/getCategories', 'App\Http\Controllers\API\AppController@getCategories');
    Route::get('/getResources', 'App\Http\Controllers\API\AppController@getResources');
    Route::get('/getResourcesScreen', 'App\Http\Controllers\API\AppController@getResourcesScreen');
    Route::get('/getResourceLessons', 'App\Http\Controllers\API\AppController@getResourceLessons');

    Route::get('/getNeedMainCategory', 'App\Http\Controllers\API\AppController@getNeedMainCategory');
    Route::get('/getNeedSubCategory', 'App\Http\Controllers\API\AppController@getNeedSubCategory');
    
    Route::get('/getWorthyCauses', 'App\Http\Controllers\API\AppController@getWorthyCauses');
    Route::get('/getSubWorthyCauses', 'App\Http\Controllers\API\AppController@getSubWorthyCauses');
    Route::get('/getWorthyCausesDetails', 'App\Http\Controllers\API\AppController@getWorthyCausesDetails');

    Route::post('/startFundRaise', 'App\Http\Controllers\API\UserController@startFundRaise');



    
    Route::group(['middleware' => 'auth:api'], function () {


        Route::get('/profile', 'App\Http\Controllers\API\UserController@profile');  
        Route::post('/editProfile', 'App\Http\Controllers\API\UserController@editProfile');
        Route::get('/logout', 'App\Http\Controllers\API\UserController@logout');  
        
        
        Route::get('/getMyNotifications', 'App\Http\Controllers\API\AppController@getMyNotifications');

        
        Route::get('/userHomeScreen', 'App\Http\Controllers\API\AppController@userHomeScreen'); 
        Route::get('/userHomeScreenFilter', 'App\Http\Controllers\API\AppController@userHomeScreenFilter');
        Route::get('/getSubNeedsTypes', 'App\Http\Controllers\API\AppController@getSubNeedsTypes');

        Route::get('/getOpportunities', 'App\Http\Controllers\API\AppController@getOpportunities');
        Route::get('/filterOpportunities', 'App\Http\Controllers\API\AppController@filterOpportunities');
        Route::get('/getOpportunityDetails', 'App\Http\Controllers\API\AppController@getOpportunityDetails');


        Route::post('/sendContactMsg', 'App\Http\Controllers\API\AppController@sendContactMsg');

        Route::post('/createVolunteerRequest', 'App\Http\Controllers\API\AppController@createVolunteerRequest');
        Route::post('/createProject', 'App\Http\Controllers\API\AppController@createProject');
        Route::post('/createMinistryIdea', 'App\Http\Controllers\API\AppController@createMinistryIdea');
        Route::post('/createFeedback', 'App\Http\Controllers\API\AppController@createFeedback');

        Route::post('/createNewGoal', 'App\Http\Controllers\API\AppController@createNewGoal');
        Route::post('/createNewTask', 'App\Http\Controllers\API\AppController@createNewTask');

        Route::get('/getMyGoalsBenchmarks', 'App\Http\Controllers\API\AppController@getMyGoalsBenchmarks');
        Route::get('/getMyTaskManager', 'App\Http\Controllers\API\AppController@getMyTaskManager');


        Route::post('/markGoalCompleted', 'App\Http\Controllers\API\AppController@markGoalCompleted');
        Route::post('/markTaskCompleted', 'App\Http\Controllers\API\AppController@markTaskCompleted');

        Route::post('/makeDonation', 'App\Http\Controllers\API\AppController@makeDonation');





    // Route::get('/viewAllTasks', 'API\AppController@viewAllTasks');
        // Route::post('/markTaskDone', 'API\AppController@markTaskDone');


        // Route::post('/completeYourRequest', 'API\AppController@completeYourRequest');
        // Route::get('/getGoals', 'API\AppController@getGoals');
        // Route::get('/getLessons', 'API\AppController@getLessons');

        // Route::post('/createNewOpportunity', 'API\AppController@createNewOpportunity');
        // Route::get('/getMyOpportunities', 'API\AppController@getMyOpportunities');
        // Route::post('/updateOpportunity', 'API\AppController@updateOpportunity');
        // Route::post('/deletedOpportunity', 'API\AppController@deletedOpportunity');

        
        
  



    });



