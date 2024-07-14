<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ObjectNotFound extends Exception
{
    public function report() {
        Log::error($this);
    }
}
