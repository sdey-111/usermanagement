
<?php

    Route::get('test/fetchdata', ['as' => 'test.fetchdata', 'uses' => 'TestController@fetchData']);        
    Route::post('test/updatedata', ['as' => 'test.updatedata', 'uses' => 'TestController@updateData']);        
    
    Route::get('/', 'TestController@create');
    Route::delete('/deleteprocess', 'TestController@destroy');
      //////////////////////////////Resource Route Start/////////////////////////////////
        Route::resource('test', 'TestController');
        //////////////////////////////Resource Route End///////////////////////////////////
 
