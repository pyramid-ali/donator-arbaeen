<?php

namespace App\Arbaeen\Stages;


class GetDonationProductName extends Base
{
    use Message;

    public function isOk()
    {
        return $this->getText();
    }
    
    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $this->sendMessage(__('telegram.errors.get_donation_product_name'));
    }

    protected function respondToClient()
    {
        $this->replaceMessage(__('telegram.messages.get_donation_product_name', ['product_name' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(ShowDonationProductAmountForm::class);
        $this->addStageOption(['donation_product_name' => $this->getText()]);
    }
}
