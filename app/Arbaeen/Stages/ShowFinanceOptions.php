<?php

namespace App\Arbaeen\Stages;


use App\Arbaeen\Utilities\Button;

class ShowFinanceOptions extends Base
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
        $this->replaceMessage(__('telegram.messages.show_finance_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectFinanceOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.card_payment'), 'callback_data' => 'card_payment'],
            ['text' => __('telegram.words.online_payment'), 'callback_data' => 'online_payment']
        ]);
    }
}
