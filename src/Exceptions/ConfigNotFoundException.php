<?php

namespace Task\Exceptions;

class ConfigNotFoundException extends \Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message);
    }
}
