<?php

namespace App\Exceptions;

class Exception extends \Exception
{
    public $status = 500;

    public function __construct($message)
    {
        parent::__construct($message);
    }

    public function getStatusCode()
    {
        return $this->status;
    }
}
