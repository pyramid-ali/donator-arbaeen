<?php

namespace App\Arbaeen\Stages;


class GetNationalNumber extends Base
{
    use Message;

    protected function isOk()
    {
        $text = $this->getText();
        return $text && $this->checkNationalCode($text);
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $text = __('telegram.errors.get_national_number');

        if ($this->getText()) {
            $text = __('telegram.errors.wrong_national_number', ['national_number' => $this->getText()]);
        }

        $this->sendMessage($text);
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.get_national_number', ['national_number' => $this->getText()]));
    }

    protected function done()
    {
        $this->setStage(ShowNationalCardImageForm::class);
        $this->addStageOption(['national_number' => $this->getText()]);
    }

    protected function checkNationalCode($code)
    {
        if(!preg_match('/^[0-9]{10}$/',$code))
            return false;
        for($i = 0; $i < 10; $i++)
            if(preg_match('/^'.$i.'{10}$/',$code))
                return false;
        for($i = 0, $sum = 0; $i<9; $i++)
            $sum += ((10 - $i) * intval(substr($code, $i,1)));
        $ret = $sum % 11;
        $parity = intval(substr($code, 9,1));
        if(($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11-$parity))
            return true;
        return false;
    }
}
