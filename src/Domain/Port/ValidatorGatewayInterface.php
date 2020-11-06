<?php

declare(strict_types=1);

namespace App\Domain\Port;

use App\Domain\ValidationViolationList;

interface ValidatorGatewayInterface
{
    public function validate($value): ValidationViolationList;
}
