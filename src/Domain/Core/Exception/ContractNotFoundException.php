<?php

namespace App\Domain\Core\Exception;

class ContractNotFoundException extends \Exception
{
    protected $message = 'No active contract between client and supervisor';
}