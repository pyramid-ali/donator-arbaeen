<?php

namespace App\Arbaeen\Stages;


class CardPayment extends Base
{

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        // TODO: Implement respondToError() method.
    }

    protected function respondToClient()
    {
        $this->replaceMessage(__('telegram.messages.card_payment'));
    }

    protected function done()
    {
        $this->setStage(EndStage::class);
    }
}
