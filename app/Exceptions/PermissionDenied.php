<?php

namespace App\Exceptions;

use Exception;

class PermissionDenied extends Exception
{
    protected $message = "Dont have permission to perform action.";
}
