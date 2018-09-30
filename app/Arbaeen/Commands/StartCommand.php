<?php

namespace App\Arbaeen\Commands;

use Alish\Telegram\TelegramCommand;
use App\Arbaeen\Loaders\Kernel;
use App\Arbaeen\Stages\ShowHelpOptions;

class StartCommand extends TelegramCommand
{

    public function handler()
    {
        $client = resolve('Client')->get();
        $client->stage()->create([
            'name' => ShowHelpOptions::class
        ]);

        $this->sendMessage(__('telegram.commands.start'));

        (new Kernel($this->update))->process();
    }
}
