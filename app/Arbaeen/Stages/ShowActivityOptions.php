<?php

namespace App\Arbaeen\Stages;


use App\Arbaeen\Utilities\Button;

class ShowActivityOptions extends Base
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
        $this->replaceMessage(__('telegram.messages.show_activity_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectActivityOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.therapeutic'), 'callback_data' => 'therapeutic'],
            ['text' => __('telegram.words.backing'), 'callback_data' => 'backing'],
            ['text' => __('telegram.words.other'), 'callback_data' => 'other_activity']
        ]);
    }
}
