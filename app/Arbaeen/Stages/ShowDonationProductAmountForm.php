<?php

namespace App\Arbaeen\Stages;


class ShowDonationProductAmountForm extends Base
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
        $this->replaceMessage(__('telegram.messages.show_donation_product_amount'));
    }

    protected function done()
    {
        $this->setStage(GetDonationProductAmount::class);
    }
}
