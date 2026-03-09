<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HrmisApiCtrl extends Controller
{
    //



    // Fetch positions from HRMIS
   // Fetch positions from HRMIS API
    public function positionsJson()
    {
      
    $baseUrl = config('services.hrmis.url');
    $token = config('services.hrmis.token');

    Log::info('HRMIS URL: '.$baseUrl);

    try {
        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 10,
            'verify' => false // for local https if needed
        ]);

            $response = $client->get('/api/positions', [
                'query' => ['api_token' => $token]
            ]);

        
        $result = json_decode($response->getBody(), true);

        return response()->json($result['data'] ?? []);

    } catch (\Exception $e){
        Log::error('HRMIS API error', ['msg' => $e->getMessage()]);
        return response()->json([]);
    }
}

public function getPositionById($id)
{
    $baseUrl = config('services.hrmis.url');
    $token   = config('services.hrmis.token');

    try {
        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout' => 10,
            'verify' => false
        ]);

        $response = $client->get('/api/positions', [
            'query' => ['api_token' => $token]
        ]);

        $result = json_decode($response->getBody(), true);
        $positions = $result['data'] ?? [];

        foreach ($positions as $pos) {
            if ($pos['id'] == $id) {
                return $pos;
            }
        }

        return null;

    } catch (\Exception $e) {
        Log::error('HRMIS getPositionById error', ['msg' => $e->getMessage()]);
        return null;
    }
}
}
