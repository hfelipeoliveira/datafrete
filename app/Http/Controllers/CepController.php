<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller
{
    public function cepValido($cep){

        //Requisita dados das cidades e estados do brasil
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://www.cepaberto.com/api/v3/cep?cep='. $cep, [
            'headers' => [
                'Authorization' => 'Token token='. getenv('API_CEP_ABERTO_TOKEN')
            ]
        ]);
        
        $json = json_decode($response->getBody());
        
        if(isset($json->cep)){
            return response()->json([
                'validade' => true
            ]);
        }else{
            return response()->json([
                'validade' => false
            ]);
        }

        
        
    }
}
