<?php

$app->group(['prefix' => '/user', 'middleware' => 'myRoute'], function($app) {
    $app->get('', ['uses' => 'UserController@getUsers']);

    $app->post('/signup', ['uses' => 'UserController@signup']);
    $app->put('/signin', ['uses' => 'UserController@signin']);

    $app->post('/{userId}/changePassword', ['uses' => 'UserController@changePassword']);
});
