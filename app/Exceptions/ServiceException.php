<?php

namespace App\Exceptions;

use Exception;

class ServiceException extends Exception
{
    protected $statusCode;

    public function __construct($message = "Something went wrong", $statusCode = 404)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
