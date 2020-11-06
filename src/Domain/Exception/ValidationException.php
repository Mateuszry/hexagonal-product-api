<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\ValidationViolationList;
use Exception;

class ValidationException extends Exception
{
    public ValidationViolationList $validationViolationList;

    public function __construct(ValidationViolationList $validationViolationList)
    {
        $this->validationViolationList = $validationViolationList;
        parent::__construct();
    }
}
