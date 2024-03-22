<?php
declare(strict_types=1);


namespace GlobalEmergency\Apuntate\Tests\Acceptance\Rest;

use GlobalEmergency\Apuntate\Shared\Infrastructure\Rest\HealthController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthControllerTest extends WebTestCase
{
    public function testHealth(): void
    {
        $client = static::createClient();
        $client->request('GET', '/health');
        self::assertResponseIsSuccessful();
    }
}
