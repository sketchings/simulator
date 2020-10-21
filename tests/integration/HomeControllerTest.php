<?php

declare(strict_types=1);

namespace Tests\integration;

class HomeControllerTest extends TestCase
{
    public function testHomepage()
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('api', $result);
    }
}
