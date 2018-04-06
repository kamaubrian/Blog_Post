<?php
/**
 * Created by PhpStorm.
 * User: brian-kamau
 * Date: 4/6/18
 * Time: 12:22 AM
 */

namespace App\Conversations;


use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class DefaultConversation
{

    public function defaultQuestion(){
        $question = Question::create('Huh - you woke me up, What do you need')
            ->addButtons([
                Button::create('Random Dog Photo')->value('random'),
                Button::create('A photo by breed')->value('breed'),
                Button::create('A photo by sub-breed')->value('sub-breed'),
            ]);
        return $this->ask($question,function(Answer $answer){
           if($answer->isInteractiveMessageReply()){
               switch($answer->getValue()){
                   case 'random':
                       $this->say((new \App\Services\DogService)->random());
                       break;
                   case 'breed':
                       $this->askForBreedName();
                       break;
                   case 'sub-breed':
                       $this->askForSubBreed();
                       break;

               }
           }
        });
    }

    public function askForBreedName(){

        $this->ask('Whats the Breed Name',function(Answer $answer){
           $name = $answer->getText();

           $this->say((new \App\Services\DogService) ->byBreed($name));
        });
    }

    public function askForSubBreed(){
        $this->ask('Whats the breed and sub-breed names? ex:hound:afghan',function(Answer $answer){
           $answer = explode(':',$answer->getText());
           $this->say((new \App\Services\DogService) ->bySubBreed($answer[0],$answer[1]));
        });
    }
    public function run(){
        $this->defaultQuestion();
    }

}