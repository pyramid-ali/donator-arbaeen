<?php

namespace App\Arbaeen\Stages;


class GetPaymentAmount extends Base
{
    use Message;
    private $limit = 10000;

    protected function isOk()
    {
        $text = $this->getText();
        return $text && is_numeric($text) && $text >= $this->limit;
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $text = __('telegram.errors.get_payment_amount');

        if (!is_numeric($this->getText())) {
            $text = __('telegram.errors.wrong_payment_amount');
        } else {
            if ($this->getText() < $this->limit) {
                $text = __('telegram.errors.low_payment_amount', ['limit' => number_format($this->limit)]);
            }
        }

        $this->sendMessage($text);
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_payment_amount', ['payment_amount' => number_format($this->getText())]));
    }

    protected function done()
    {
        $this->setStage(OnlinePayment::class);
        $this->addStageOption(['payment_amount' => $this->getText()]);
    }
}
