<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/30/18
 * Time: 9:42 AM
 */

namespace App\Arbaeen\Loaders;


use Alish\Telegram\Facades\Telegram;
use Alish\Telegram\TelegramLoader;
use Illuminate\Support\Facades\Auth;

class LoginUser extends TelegramLoader
{

    public function process()
    {
        $client = resolve('Client')->get();

        if ($text = optional($this->update->getMessage())->getText()) {
            if (!str_start($text, 'login_')) {
                return;
            }

            $data = explode('_', $text);

            if(count($data) > 2 && Auth::once(['email' => $data[1], 'password' => $data[2]])) {
                Auth::user()->clients()->attach($client);
                $this->sendMessage($client, __('telegram.messages.login'));
                exit();
            }

        }

    }

    public function sendMessage($client, $text)
    {
        Telegram::chatId($client->tid)->sendMessage(['text' => $text]);
    }
}
