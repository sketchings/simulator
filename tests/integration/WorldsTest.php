<?php

declare(strict_types=1);

namespace Tests\integration;

class WorldsTest extends TestCase
{
    private static $id;

    public function testCreate()
    {
        $params = [
            'terrain' => 'T :.',

        ];
        $req = $this->createRequest('POST', '/api/v1/worlds');
        $request = $req->withParsedBody($params);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetAll()
    {
        $request = $this->createRequest('GET', '/api/v1/worlds');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOne()
    {
        $request = $this->createRequest('GET', '/api/v1/worlds/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('text/plain', $response->getHeaderLine('Content-type'));
        //$this->assertStringContainsString('id', $result);
        //$this->assertStringContainsString('terrain', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOneNotFound()
    {
        $request = $this->createRequest('GET', '/api/v1/worlds/123456789');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function fixTestUpdate()
    {
        $req = $this->createRequest('POST', '/api/v1/worlds/' . self::$id);
        $request = $req->withParsedBody(['terrain' => 'T. :']);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDelete()
    {
        $request = $this->createRequest('DELETE', '/api/v1/worlds/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
