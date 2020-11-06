<?php

declare(strict_types=1);

namespace App\Application\Event;

use App\Domain\Port\Event\EventInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatedProductEventHandler implements MessageHandlerInterface
{
    public function __invoke(EventInterface $event)
    {
        // Handle event logic according to the requirements
    }
}
