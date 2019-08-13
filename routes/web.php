<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/',['as' => 'Home', function () use ($router) {
    return $router->app->version();
}]);

$router->get('hello',function () use($router){
    return 'Hello World';
});

$router->post('test', ['as' => 'test', 'uses' => 'ExampleController@Test']);
$router->post('add-device', ['as' => 'add-device', 'uses' => 'DeviceController@addDevice']);
$router->post('add-room', ['as' => 'add-room', 'uses' => 'RoomController@addRoom']);
$router->post('add-device-only-ip', ['as' => 'add-device-only-ip', 'uses' => 'DeviceController@addDeviceIp']);
$router->group(['prefix' => 'test1'], function () use($router){
    $router->get('test11',function (){
        echo "test1";
    });

    $router->get('test12',function (){
        echo "test2";
    });
});
