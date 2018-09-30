<?php

namespace App\Arbaeen\Stages;


class GetDonationProductAmount extends Base
{
    use Message;

    protected function isOk()
    {
        return $this->getText();
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $this->sendMessage(__('telegram.errors.get_donation_product_amount'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_donation_product_amount', ['product_amount' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(Signup::class);
        $this->addStageOption(['donation_product_amount' => $this->getText()]);
    }
}
