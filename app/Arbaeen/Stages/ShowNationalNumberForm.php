<?php

namespace App\Arbaeen\Stages;


class ShowNationalNumberForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_national_number_form'));
    }

    protected function done()
    {
        $this->setStage(GetNationalNumber::class);
    }
}
