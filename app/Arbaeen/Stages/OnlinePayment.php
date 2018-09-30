<?php

namespace App\Arbaeen\Stages;

use App\Arbaeen\Utilities\Button;

class OnlinePayment extends Base
{

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        // TODO: Implement respondToError() method.
    }

    protected function respondToClient()
    {
        $this->sendMessage(__('telegram.messages.online_payment'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(EndStage::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.buttons.online_payment'), 'url' => 'https://zarinp.al/@ninix']
        ]);
    }
}
