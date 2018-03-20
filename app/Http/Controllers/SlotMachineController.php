<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Abstracts\SpinAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class SlotMachineController extends SpinAbstract
{
    /**
     * Main method
     *
     * @return void
     */
    function play():void
    {
        //Get Config file
        //TODO: Get game configuration from database provider instead of file provider
        $json = json_decode(Storage::get('games.json'), true);

        //Take the first entry
        $defaultGame = array_keys($json)[0];
        $this->config = $json[$defaultGame];

        //Optional
        //TODO: Should be taken from Http Request
        $this->bet = 100;

        //Shuffle faces and Generate the matrix depending on strategy
        //You can add your own shuffle and map strategy without changing the code
        //Code Scalability has been prioritized
        $this->matrix = $this->map($this->config['faces'], $this->config);

        //TODO: Spin x times, check balance
        echo new JsonResponse($this->spin());
    }
}
