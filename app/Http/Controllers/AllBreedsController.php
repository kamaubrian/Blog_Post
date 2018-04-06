<?php

namespace App\Http\Controllers;
use App\Services\DogService;
use Illuminate\Http\Request;

class AllBreedsController extends Controller
{
    public function __construct()
    {
        $this->photos = new DogService;
    }

    public function random($bot){
        $bot->reply($this->photos->random());
    }
    public function byBreed($bot,$name){
        $bot->reply($this->photos->byBreed($name));
    }

}
