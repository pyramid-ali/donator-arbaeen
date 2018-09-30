<?php

namespace App\Arbaeen\Services;


use App\Client;
use Illuminate\Support\Facades\Log;

class ClientWrapper
{

    protected $client;

    public function set(Client $client)
    {
        $this->client = $client;
    }

    public function get()
    {
        return $this->client;
    }

}
