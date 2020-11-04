<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller;

use Coduo\PHPMatcher\PHPUnit\PHPMatcherAssertions;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ControllerTestCase extends WebTestCase
{
    use PHPMatcherAssertions;

    protected static KernelBrowser $client;

    public function setUp(): void
    {
        self::$client = static::createClient();
    }

    protected function sendRequest(string $method, string $uri, array $content = []): void
    {
        self::$client->request($method, $uri, [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($content));
    }

    protected function assertResponseContentMatchesPattern(string $pattern): void
    {
        $this->assertMatchesPattern($pattern, self::$client->getResponse()->getContent());
    }
}
