<?php

// use cart controller
use App\Http\Controllers\ReviewController;

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('reviews', 'ReviewController@index');
    $router->post('reviews', 'ReviewController@create');
    $router->get('reviews/products/{productId}', 'ReviewController@getReviews');
    $router->put('reviews/{id}', 'ReviewController@update');
    $router->delete('reviews/{id}', 'ReviewController@delete');
});

