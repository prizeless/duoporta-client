<?php

namespace Duoporta\Exceptions;

class MakesError extends DuoportaException
{
    public function __construct($message = 'Error getting car makes.')
    {
        parent::__construct($message);
    }
}
