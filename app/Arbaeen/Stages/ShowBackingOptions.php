<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/29/18
 * Time: 10:34 AM
 */

namespace App\Arbaeen\Stages;


use App\Arbaeen\Utilities\Button;

class ShowBackingOptions extends Base
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
        $this->replaceMessage(__('telegram.messages.show_backing_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectBackingOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.worker'), 'callback_data' => 'worker'],
            ['text' => __('telegram.words.receipt'), 'callback_data' => 'receipt'],
            ['text' => __('telegram.words.service'), 'callback_data' => 'service'],
            ['text' => __('telegram.words.protection'), 'callback_data' => 'protection'],
            ['text' => __('telegram.words.installation'), 'callback_data' => 'installation'],
            ['text' => __('telegram.words.health_expert'), 'callback_data' => 'health_expert'],
            ['text' => __('telegram.words.it_expert'), 'callback_data' => 'it_expert'],
            ['text' => __('telegram.words.other'), 'callback_data' => 'other_backing'],
        ]);
    }
}
