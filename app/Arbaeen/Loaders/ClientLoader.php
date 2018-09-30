<?php

namespace App\Arbaeen\Loaders;


use Alish\Telegram\Facades\Telegram;
use Alish\Telegram\TelegramLoader;
use App\Client;

class ClientLoader extends TelegramLoader
{

    public function process()
    {
        $client = $this->getClient(Telegram::getUser());
        resolve('Client')->set($client);
    }

    private function getClient($telegramUser)
    {
        return Client::updateOrCreate([
            'tid' => $telegramUser->getId()
        ], [
            'first_name' => $telegramUser->getFirstName(),
            'last_name' => $telegramUser->getLastName(),
            'username' => $telegramUser->getUsername(),
            'language_code' => $telegramUser->getLanguageCode(),
            'is_bot' => $telegramUser->getIsBot(),
        ]);
    }
}
