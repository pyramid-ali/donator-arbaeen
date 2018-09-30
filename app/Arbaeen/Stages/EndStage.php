<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/30/18
 * Time: 12:54 AM
 */

namespace App\Arbaeen\Stages;


use App\Events\ClientStageCompleted;

class EndStage extends Base
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
        $this->sendMessage(__('telegram.messages.end_stage'));
    }

    protected function done()
    {
        $this->resetStage();
        event(new ClientStageCompleted($this->client));
    }
}
