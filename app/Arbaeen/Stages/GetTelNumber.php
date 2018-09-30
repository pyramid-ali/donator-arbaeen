<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:50 AM
 */

namespace App\Arbaeen\Stages;


class GetTelNumber extends Base
{
    use Message;

    protected function isOk()
    {
        $text = $this->getText();
        return $text && preg_match('/^(0|((\+)?98))?[9]\d{9}$/', $text);
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        if ($this->getText()) {
            $this->sendMessage(__('telegram.errors.wrong_tel_number_format', ['tel_number' => $this->getText()]));
        }
        else {
            $this->sendMessage(__('telegram.errors.get_tel_number'));
        }

    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_tel_number', ['tel_number' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(SuccessfulSignup::class);
        $this->addStageOption(['tel_number' => $this->getText()]);
    }
}
