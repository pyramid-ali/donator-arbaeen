<?php

namespace App\Arbaeen\Stages;


class ShowBackingServiceNameForm extends Base
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
        $this->replaceMessage(__('telegram.messages.show_backing_service_name_form'));
    }

    protected function done()
    {
        $this->setStage(GetBackingServiceName::class);
    }
}
