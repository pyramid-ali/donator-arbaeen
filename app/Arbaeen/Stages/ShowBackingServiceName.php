<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/30/18
 * Time: 2:33 AM
 */

namespace App\Arbaeen\Stages;


class ShowBackingServiceName extends Base
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
        $this->replaceMessage(__('telegram.messages.show_backing_service_name'));
    }

    protected function done()
    {
        $this->setStage(GetBackingServiceName::class);
    }
}
