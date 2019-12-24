<?php

Route::group([
    'namespace' => 'Api',
], function() {
    Route::group([
    ], function() {
        Route::get('authorizations/test', 'AuthorizationsController@test')
            ->name('api.authorizations.test');

        // 小程序登录
        Route::post('weapp/authorizations', 'AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');

        // 刷新token
        Route::post('authorizations/update', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        Route::post('authorizations/destroy', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');

    });

    Route::group([
    ], function () {
        // 游客可以访问的接口
        Route::post('images/store', 'ImagesController@store')
            ->name('api.images.store');

        Route::get('things', 'ThingsController@index')
            ->name('api.things.index');
        Route::get('user/which', 'UsersController@user')
            ->name('api.users.which');



        // 需要 token 验证的接口
        Route::group(['middleware' => 'auth:api'], function($api) {

            // 当前登录用户信息
            Route::get('user', 'UsersController@me')
                ->name('api.users.me');

            Route::post('contracts/join', 'ContractsController@join')
                ->name('api.contracts.join');

            Route::get('contracts/things', 'ContractsController@things')
                ->name('api.contracts.things');

            Route::get('contract_things/memories', 'ContractThingsController@memories')
                ->name('api.contract_things.memories');

            Route::post('contract_things/create_memory', 'ContractThingsController@createMemory')
                ->name('api.contract_things.create_memory');

            Route::post('contract_things/delete_memory', 'ContractThingsController@deleteMemory')
                ->name('api.contract_things.delete_memory');


        });
    });

});

