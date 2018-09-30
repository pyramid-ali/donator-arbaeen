<?php

namespace App\Arbaeen\Stages;


use Alish\Telegram\API\Update;
use App\Client;

class GetDonateAmount extends Base
{
    private $text;

    public function __construct(Update $update, Client $client)
    {
        parent::__construct($update, $client);
        $this->text = $update->getMessage()->getText();
    }

    public function isOk()
    {
        return is_numeric($this->text) && $this->text > 10000;
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $text = __('telegram.errors.wrong_donate_amount', ['amount' => $this->text]);

        if (is_numeric($this->text)) {
            $text = __('telegram.errors.low_donate_amount', ['amount' => number_format($this->text)]);
        }

        $this->sendMessage($text);
    }

    protected function respondToClient()
    {

    }

    protected function done()
    {
        $this->setStage(ShowOnlinePaymentGate::class);
        $this->addStageOption(collect(['donate_amount' => $this->text]));
    }
}
