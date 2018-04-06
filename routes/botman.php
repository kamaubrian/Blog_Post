<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello Brian!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('/random','App\Http\Controllers\AllBreedsController@random');

$botman->hears('/b {breed}','App\Http\Controllers\AllBreedsController@byBreed');

$botman->hears('/s {breed}:{subBreed}','App\Http\Controllers\SubBreedController@random');

$botman->hears('Start Conversation', 'App\Http\Controllers\ConversationController@index');

$botman->hears('default','App\Http\Controllers\ConversationController@finer');

$botman->fallback('App\Http\Controllers\FallBackController@index');