<?php

namespace App\Arbaeen\Loaders;

use Alish\Telegram\TelegramLoader;
use App\Client;
use Illuminate\Support\Facades\Log;

class Kernel extends TelegramLoader
{

    public function process()
    {
        $client = resolve('Client')->get()->fresh('stage');

        if ($stage = $client->stage) {
            do {
                $handler = $this->getHandler($client);
                $handler->handle();

            } while ($handler->shouldNextDoEarly());

            exit();
        }
    }

    private function getHandler(Client $client)
    {
        if (class_exists($handler = $client->stage->name)) {
            return new $handler($this->update, $client);
        }
    }
}
