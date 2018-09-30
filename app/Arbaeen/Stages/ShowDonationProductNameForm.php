<?php

namespace App\Arbaeen\Stages;


class ShowDonationProductNameForm extends Base
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
        $this->replaceMessage(__('telegram.messages.show_donation_product_name'));
    }

    protected function done()
    {
        $this->setStage(GetDonationProductName::class);
    }
}
