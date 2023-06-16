<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ViaCepController extends Controller
{
    public function GetZipCode($zip_code){

        $url = 'https://viacep.com.br/ws/'.$zip_code.'/json/';

        $response = file_get_contents($url);

        if ($response !== false) {
            return json_decode($response);
        } else {
            throw new Exception('Error to get the zip_code');
        }
    
    }
}
