<?php

namespace App\Services\Utility;

use Exception;

//wrap exceptions to know where the orginal exception happened
class DatabaseException extends Exception 
{
    //Non-default constructor
    public function __construct($message, $code = 0, Exception $previous = null)
    {
       //Call super class
       parent::__construct($message, $code, $previous);
    }
}
