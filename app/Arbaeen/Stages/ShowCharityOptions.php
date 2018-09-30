<?php

namespace App\Arbaeen\Stages;

use App\Arbaeen\Utilities\Button;

class ShowCharityOptions extends Base
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
        $this->replaceMessage(__('telegram.messages.show_charity_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectCharityOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.finance'), 'callback_data' => 'finance'],
            ['text' => __('telegram.words.equipment_items'), 'callback_data' => 'equipment_items'],
            ['text' => __('telegram.words.consumable_items'), 'callback_data' => 'consumable_items'],
            ['text' => __('telegram.words.drug_items'), 'callback_data' => 'drug_items'],
            ['text' => __('telegram.words.other'), 'callback_data' => 'other']
        ]);
    }
}
