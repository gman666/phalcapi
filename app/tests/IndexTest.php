<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase {

    public function testGET() {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:8000/api/user/123');
        $data = json_decode($response->getBody(true), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(123, $data['id']);
        $this->assertEquals("Gordon", $data['first_name']);
        $this->assertEquals("Test", $data['last_name']);
        $this->assertEquals("QLD", $data['state']);
    }

}