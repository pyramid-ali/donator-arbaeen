<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/30/18
 * Time: 1:15 AM
 */

namespace App\Arbaeen\Stages;


trait Message
{

    public function getText()
    {
        return optional($this->update->getMessage())->getText();
    }

}
