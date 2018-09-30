<?php

namespace App\Arbaeen\Stages;


class ShowOnlinePaymentGate extends Base
{

    public function shouldNextDoEarly()
    {
        // TODO: Implement shouldNextDoEarly() method.
    }

    protected function respondToError()
    {
        // TODO: Implement respondToError() method.
    }

    protected function respondToClient()
    {
        // TODO: Implement respondToClient() method.
    }

    protected function done()
    {
        $this->setStage(WaitingForPayment::class);
    }
}
