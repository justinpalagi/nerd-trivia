<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/game', 'GameController@newGame');

Route::post('/game/{gameCode}/participant', 'ParticipantController@joinGame');

Route::get('/question', 'GameController@nextQuestion')->middleware('auth:api');