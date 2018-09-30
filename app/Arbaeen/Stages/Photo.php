<?php

namespace App\Arbaeen\Stages;


trait Photo
{

    public function hasPhoto()
    {
        return !!optional($this->update->getMessage())->getPhoto();
    }

    public function photos()
    {
        return optional($this->update->getMessage())->getPhoto();
    }

    public function getPhotoArray()
    {
        $photos = null;

        foreach ($this->photos() as $photo) {
            $photos[] = [
                'file_id' => $photo->getFileId(),
                'width' => $photo->getWidth(),
                'height' => $photo->getHeight(),
                'file_size' => $photo->getFileSize(),
            ];
        }

        return $photos;
    }

}
