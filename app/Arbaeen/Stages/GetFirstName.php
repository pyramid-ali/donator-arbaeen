<?php

namespace App\Arbaeen\Stages;


class GetFirstName extends Base
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
        $this->sendMessage(__('telegram.errors.get_first_name'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_first_name', ['first_name' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(ShowLastNameForm::class);
        $this->addStageOption(['first_name' => $this->getText()]);
    }
}
