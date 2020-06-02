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

$router->get('/', function() {
    return "<h1>Am Alive</h1>";
});

$router->post('/add', ['uses' => 'ContactController@add_contact']);
$router->get('/contacts', ['uses' => 'ContactController@get_contacts']);
$router->delete('/contact', ['uses' => 'ContactController@delete_contact']);
$router->patch('/contact', ['uses' => 'ContactController@edit_contact']);