<?php

namespace App\Arbaeen\Stages;


use Alish\Telegram\API\Update;
use Alish\Telegram\Facades\Telegram;
use App\Client;

abstract class Base
{
    use StageHelper;

    protected $update;
    protected $client;
    protected $error;

    public function __construct(Update $update, Client $client)
    {
        $this->update = $update;
        $this->client = $client;
    }

    public function handle() {
        if (!$this->isOk()) {
            $this->respondToError();
            exit();
        }

        $this->respondToClient();

        $this->done();
    }

    protected function isOk()
    {
        return true;
    }

    protected function sendMessage($text, $buttons = null)
    {
        Telegram::chatId($this->client->tid)->sendMessage(['text' => $text, 'reply_markup' => $buttons]);
    }

    protected function answerCallback($text = null)
    {
        if ($query = $this->update->getCallbackQuery()) {
            return Telegram::answerCallbackQuery(['callback_query_id' => $query->getId(), 'text' => $text]);
        }

        return null;
    }

    public function replaceMessage($text, $buttons = null)
    {
        $message = optional($this->update->getCallbackQuery())->getMessage();
        $messageId = optional($message)->getMessageId();

        if ($messageId) {
            return Telegram::chatId($this->client->tid)->editMessageText(['message_id' => $messageId, 'text' => $text, 'reply_markup' => $buttons]);
        }
        else {
            $this->sendMessage($text, $buttons);
        }
    }

    abstract public function shouldNextDoEarly();

    abstract protected function respondToError();
    abstract protected function respondToClient();
    abstract protected function done();

}
