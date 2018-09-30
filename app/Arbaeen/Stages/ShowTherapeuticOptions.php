<?php

namespace App\Arbaeen\Stages;


use App\Arbaeen\Utilities\Button;

class ShowTherapeuticOptions extends Base
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
        $this->replaceMessage(__('telegram.show_therapeutic_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectTherapeuticOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.dentist'), 'callback_data' => 'dentist'],
            ['text' => __('telegram.words.doctor'), 'callback_data' => 'doctor'],
            ['text' => __('telegram.words.nurse'), 'callback_data' => 'nurse'],
            ['text' => __('telegram.words.drug_store'), 'callback_data' => 'drug_store'],
            ['text' => __('telegram.words.paramedic'), 'callback_data' => 'paramedic'],
            ['text' => __('telegram.words.paramedical'), 'callback_data' => 'paramedical'],
            ['text' => __('telegram.words.other'), 'callback_data' => 'other_therapeutic']
        ], 2);
    }
}
