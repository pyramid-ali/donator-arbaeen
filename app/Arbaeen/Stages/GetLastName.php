<?php

namespace App\Arbaeen\Stages;


class GetLastName extends Base
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
        $this->sendMessage(__('telegram.errors.get_last_name'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_last_name', ['last_name' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(ShowNationalNumberForm::class);
        $this->addStageOption(['last_name' => $this->getText()]);
    }
}
