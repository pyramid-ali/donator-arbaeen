<?php

namespace App\Arbaeen\Stages;


class GetNationalCardImage extends Base
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
        $this->sendMessage(__('telegram.errors.get_national_card_image'));
    }

    protected function respondToClient()
    {
        // TODO: Implement respondToClient() method.
    }

    protected function done()
    {
        $this->setStage(ShowPassportNumberForm::class);
        $this->addStageOption(['national_card_images' => $this->getPhotoArray()]);
    }
}
