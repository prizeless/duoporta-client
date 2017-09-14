<?php

namespace Duoporta\Exceptions;

class JsonDecodeError extends DuoportaException
{
    public function __construct($message = 'Error parsing response.')
    {
        parent::__construct($message);
    }
}
