<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:44 AM
 */

namespace App\Arbaeen\Stages;


class ShowFirstNameForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_first_name_form'));
    }

    protected function done()
    {
        $this->setStage(GetFirstName::class);
    }
}
