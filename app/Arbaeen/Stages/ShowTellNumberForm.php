<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:49 AM
 */

namespace App\Arbaeen\Stages;


class ShowTellNumberForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_tell_number_form'));
    }

    protected function done()
    {
        $this->setStage(GetTelNumber::class);
    }
}
