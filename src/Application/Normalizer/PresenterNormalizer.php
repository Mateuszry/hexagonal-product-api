<?php

declare(strict_types=1);

namespace App\Application\Normalizer;

use App\Application\Presenter\DataPresenterInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;

final class PresenterNormalizer implements NormalizableInterface, ContextAwareNormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'data' => $object,
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof DataPresenterInterface;
    }
}
