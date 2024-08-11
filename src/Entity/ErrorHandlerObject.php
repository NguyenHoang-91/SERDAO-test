<?php

namespace App\Entity;

class ErrorHandlerObject
{
    public $errorMessage;

    public function __construct()
    {
        $this->errorMessage = "";
    }
    public function setErrorMessage($msg)
    {
        $this->errorMessage = $msg;
    }
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}