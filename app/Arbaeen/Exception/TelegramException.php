<?php
/**
 * Created by PhpStorm.
 * User: alish
 * Date: 9/25/18
 * Time: 5:18 AM
 */

namespace App\Arbaeen\Exception;


use Illuminate\Support\Facades\Log;

class TelegramException
{
    private $error;

    public function __construct(\Exception $error)
    {
        $this->error = $error;
    }

    public function handler()
    {
        Log::info($this->error);
    }
    
}
