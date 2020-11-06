<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Port\ValidatorGatewayInterface;
use App\Domain\ValidationViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ValidatorGatewayInterface
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($value): ValidationViolationList
    {
        $validationViolationList = new ValidationViolationList();
        $violations = $this->validator->validate($value);
        foreach ($violations as $violation) {
            $validationViolationList->addViolation($violation->getPropertyPath(), $violation->getMessage());
        }

        return $validationViolationList;
    }
}
