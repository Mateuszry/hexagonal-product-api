<?php

declare(strict_types=1);

namespace App\Domain;

class ValidationViolationList
{
    private array $violations = [];

    public function getViolations(): array
    {
        return $this->violations;
    }

    public function addViolation(string $field, string $message): void
    {
        $this->violations[$field][] = $message;
    }

    public function hasViolations(): bool
    {
        return count($this->violations) > 0;
    }
}
