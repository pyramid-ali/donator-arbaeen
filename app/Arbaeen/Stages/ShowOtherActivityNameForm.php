<?php

namespace App\Arbaeen\Stages;


class ShowOtherActivityNameForm extends Base
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
        $this->replaceMessage(__('telegram.messages.show_other_activity_name_form'));
    }

    protected function done()
    {
        $this->setStage(GetOtherActivityName::class);
    }
}
