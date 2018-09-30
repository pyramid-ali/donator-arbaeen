<?php

namespace App\Arbaeen\Stages;


class GetOtherActivityName extends Base
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
        $this->sendMessage(__('telegram.errors.get_other_activity_name'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_other_activity_name'));
    }

    protected function done()
    {
        $this->setStage(Signup::class);
        $this->addStageOption(['other_sub_activity' => $this->getText()]);
    }
}
