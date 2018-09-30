<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/30/18
 * Time: 4:11 AM
 */

namespace App\Arbaeen\Stages;


use App\Arbaeen\Utilities\Button;

class ShowHelpOptions extends Base
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
        $this->sendMessage(__('telegram.messages.show_help_options'), self::buttons());
    }

    protected function done()
    {
        $this->setStage(SelectHelpOption::class);
    }

    public static function buttons()
    {
        return Button::inline([
            ['text' => __('telegram.words.charity'), 'callback_data' => 'charity'],
            ['text' => __('telegram.words.activity'), 'callback_data' => 'activity']
        ]);
    }
}
