<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:48 AM
 */

namespace App\Arbaeen\Stages;


class GetPassportNumber extends Base
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
        $this->sendMessage(__('telegram.errors.get_passport_number'));
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_passport_number', ['passport_number' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(ShowPassportImageForm::class);
        $this->addStageOption(['passport_number' => $this->getText()]);
    }
}
