<?php

declare(strict_types=1);

namespace App\Application\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ConstraintViolationListNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        $violations = [];
        /** @var ConstraintViolation $violation */
        foreach ($object as $violation) {
            $violations[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return [
            'data' => [
                'violations' => $violations,
            ],
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ConstraintViolationListInterface;
    }
}
