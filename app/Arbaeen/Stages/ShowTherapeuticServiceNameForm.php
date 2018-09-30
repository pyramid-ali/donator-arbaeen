<?php

namespace App\Arbaeen\Stages;


class ShowTherapeuticServiceNameForm extends Base
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
        $this->replaceMessage(__('telegram.messages.show_therapeutic_service_name_form'));
    }

    protected function done()
    {
        $this->setStage(GetTherapeuticServiceName::class);
    }
}
