<?php

namespace App\Services\Cars;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Cars
{
    /** @var string  */
    private $url = 'https://dev-test-frontend-werpwe2p3q-uc.a.run.app';

    /**
     * @param $make
     * @return array
     */
    public function getCars($make = '')
    {
        $response = Http::get($this->url.'/cars?', [
            'make' => ucfirst($make)
        ]);

        return [
            'cars' => $response->json(),
            'token' => $response->header('your-token')
        ];
    }

    /**
     * @param $id
     * @param $token
     * @return array|mixed
     */
    public function getCar($id, $token)
    {
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->get($this->url.'/cars/'.$id);

        return $response->json();
    }
}
