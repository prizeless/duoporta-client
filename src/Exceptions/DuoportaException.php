<?php

namespace Duoporta\Exceptions;

abstract class DuoportaException extends \Exception
{
    public function __construct($message = 'Error processing your request.')
    {
        parent::__construct($message);
    }
}
