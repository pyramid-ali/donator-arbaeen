<?php

namespace App\Arbaeen\Stages;


class GetPassportImage extends Base
{
    use Photo;

    protected function isOk()
    {
        return $this->hasPhoto();
    }

    public function shouldNextDoEarly()
    {
        return true;
    }

    protected function respondToError()
    {
        $this->sendMessage(__('telegram.errors.get_passport_image'));
    }

    protected function respondToClient()
    {
//        $this->sendMessage(__('telegram.messages.get_passport_image'));
    }

    protected function done()
    {
        $this->setStage(ShowTellNumberForm::class);
        $this->addStageOption(['passport_images' => $this->getPhotoArray()]);
    }
}
