<?php

namespace App\Providers;

abstract class AbstractProvider
{
    protected function makeRequest(string $url): array
    {
        $ch = curl_init();                               
        curl_setopt($ch, CURLOPT_URL, $url);            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);           
        
        $response = curl_exec($ch);                      
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            return [];
        }
        return json_decode($response, true) ?: [];  
    }
}