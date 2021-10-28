
Route::group(['middleware' => 'cors', 'prefix' => 'service'], function () {

    Route::group(['prefix' => 'medifirst2000'], function () {
        Route::group(['prefix' => 'test'], function () {
                
            Route::post('test/PostDataLogin', 'test\test@PostDataLogin');
            Route::get('test/getSigin', 'test\test@getSigin');
            Route::get('test/getAllUser', 'test\test@getAllUser');
            
            Route::post('test/shopping', 'test\test@shopping');
            Route::get('test/Getshopping', 'test\test@Getshopping');
            Route::get('test/GetshoppingById', 'test\test@GetshoppingById');


        });
    });
});

