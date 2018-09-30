<?php

namespace App\Arbaeen\Stages;


class GetBackingServiceName extends Base
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
        $this->sendMessage(__('telegram.errors.get_backing_service_name'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_backing_service_name', ['backing_service_name' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(Signup::class);
        $this->addStageOption(['other_sub_activity' => $this->getText()]);
    }
}
