<?php

namespace Ivvy\Ads\Exceptions;

use Illuminate\Support\Facades\Log;

class AdsException extends \Exception
{
    public function log()
    {
        Log::channel('single')->error(
            'Message - ' . $this->getMessage() . PHP_EOL .
            'File - ' . $this->getFile() . PHP_EOL .
            'Line - ' . $this->getLine()
        );
    }
}