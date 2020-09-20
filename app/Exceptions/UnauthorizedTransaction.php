<?php

namespace App\Exceptions;

class UnauthorizedTransaction extends Exception
{
    public $status = 400;
}
