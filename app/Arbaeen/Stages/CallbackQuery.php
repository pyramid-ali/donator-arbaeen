<?php

namespace App\Arbaeen\Stages;


trait CallbackQuery
{

    /**
     * @return string|null
     */
    public function data()
    {
        return optional($this->update->getCallbackQuery())->getData();
    }

    /**
     * @return bool
     */
    public function isDataValid()
    {
        return in_array($this->data(), $this->validData);
    }

}
