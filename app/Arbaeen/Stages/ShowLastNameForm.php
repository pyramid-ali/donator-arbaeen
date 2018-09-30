<?php

namespace App\Arbaeen\Stages;


class ShowLastNameForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_last_name_form'));
    }

    protected function done()
    {
        $this->setStage(GetLastName::class);
    }
}
