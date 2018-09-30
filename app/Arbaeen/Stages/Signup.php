<?php

namespace App\Arbaeen\Stages;


class Signup extends Base
{

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        // TODO: Implement respondToError() method.
    }

    protected function respondToClient()
    {
        $this->replaceMessage(__('telegram.messages.signup'));
    }

    protected function done()
    {
        $this->setStage(ShowFirstNameForm::class);
    }
}
