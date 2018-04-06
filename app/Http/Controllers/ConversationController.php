<?php

namespace App\Http\Controllers;
use App\Conversations\DefaultConversation;
use App\Conversations\ExampleConversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index($bot){
        $bot->startConversation(new DefaultConversation);
    }

    public function finer($bot){
        $bot->startConversation(new ExampleConversation);
    }
}
