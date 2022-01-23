<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function apiRuc($ruc)
    {
        // $parametro = consultaRuc();
        // $http = $parametro->http.$ruc.$parametro->token;
        // $request = Http::get($http);
        // $resp = $request->json();

        $url = "https://apiperu.dev/api/ruc/".$ruc;
        $client = new \GuzzleHttp\Client(['verify'=>false]);
        $token = 'b3a460d7a377702d38463bc89f5246616873af3edee3e78f68870536c39e8082';
        $response = $client->get($url, [
            'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'Authorization' => "Bearer {$token}"
                    ]
        ]);
        $estado = $response->getStatusCode();
        $data = $response->getBody()->getContents();
        // $arreglo = [
        //     'success' => true,
        //     'data' => $data,
        // ];

        // return response()->json($arreglo);
        return $data;
    }
    public function apiDni($dni)
    {
        // $parametro = consultaDni();
        // $http = $parametro->http.$dni.$parametro->token;
        // $request = Http::get($http);
        // $resp = $request->json();
        // return $resp;

        $url = "https://apiperu.dev/api/dni/".$dni;
            $client = new \GuzzleHttp\Client(['verify'=>false]);
            $token = 'b3a460d7a377702d38463bc89f5246616873af3edee3e78f68870536c39e8082';
            $response = $client->get($url, [
                'headers' => [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer {$token}"
                        ]
            ]);
        $estado = $response->getStatusCode();
        $data = $response->getBody()->getContents();

        // $arreglo = [
        //     'success' => true,
        //     'data' => $data,
        // ];

        // return response()->json($arreglo);
        return $data;
    }
}
