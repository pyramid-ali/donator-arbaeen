<?php

namespace App\Arbaeen\Stages;


class ShowPassportImageForm extends Base
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
        $this->sendMessage(__('telegram.messages.show_passport_image_form'));
    }

    protected function done()
    {
        $this->setStage(GetPassportImage::class);
    }
}
