<?php

namespace App\Http\Controllers;


class CepController extends Controller
{
    public function cepValido(string $cep){

        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://www.cepaberto.com/api/v3/cep?cep='. $cep, [
            'headers' => [
                'Authorization' => 'Token token='. getenv('API_CEP_ABERTO_TOKEN')
            ]
        ]);
        
        $json = json_decode($response->getBody());
        
        //  Se retornar um $json->cep o CEP é válido
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

    public function coordenadas(string $cepOrigem, string $cepDestino){
        $client = new \GuzzleHttp\Client();
        $responseCepOrigem = $client->get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=BRA&limit=1&postalCode='. $cepOrigem."&key=".getenv('API_TOMTOM_TOKEN'));
        $responseCepDestino = $client->get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=BRA&limit=1&postalCode='. $cepDestino."&key=".getenv('API_TOMTOM_TOKEN'));
        
        $jsonCepOrigem = json_decode($responseCepOrigem->getBody());
        $jsonCepDestino = json_decode($responseCepDestino->getBody());

        $lat1 = (double) $jsonCepOrigem->results[0]->position->lat;
        $lon1 = (double) $jsonCepOrigem->results[0]->position->lon;
        $lat2 = (double) $jsonCepDestino->results[0]->position->lat;
        $lon2 = (double) $jsonCepDestino->results[0]->position->lon;

        //  Calculo das distâncias entre as coordenadas
        $terra = 6378.137;
        $dLat = $lat2 * M_PI / 180 - $lat1 * M_PI / 180;
        $dLon = $lon2 * M_PI / 180 - $lon1 * M_PI / 180;
        $a = sin($dLat/2) * sin($dLat/2) + cos($lat1 * M_PI / 180) * cos($lat2 * M_PI / 180) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $terra * $c;
        $distancia = round(($d), 2);

        return response()->json([
            'cepOrigem' => [
                'lat' => $lat1,
                'lon' => $lon2
            ],
            'cepDestino' => [
                'lat' => $lat2,
                'lon' => $lat2
            ],
            'distancia' => $distancia
        ]);
    }
}
