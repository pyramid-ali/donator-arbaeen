<?php

namespace App\Arbaeen\Stages;


class SuccessfulSignup extends Base
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
        $this->sendMessage(__('telegram.messages.successful_signup'));
    }

    protected function done()
    {
        $this->setStage(EndStage::class);
    }
}
