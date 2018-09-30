<?php

namespace App\Arbaeen\Stages;


class ShowPassportNumberForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_passport_number_form'));
    }

    protected function done()
    {
        $this->setStage(GetPassportNumber::class);
    }
}
