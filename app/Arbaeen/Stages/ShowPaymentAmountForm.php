<?php

namespace App\Arbaeen\Stages;


class ShowPaymentAmountForm extends Base
{

    public function shouldNextDoEarly()
    {
        return false;
    }

    protected function respondToError()
    {
        // TODO: Implement respondToError() method.
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.show_payment_amount_form'));
    }

    protected function done()
    {
        $this->setStage(GetPaymentAmount::class);
    }
}
