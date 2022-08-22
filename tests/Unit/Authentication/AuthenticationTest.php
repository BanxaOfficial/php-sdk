<?php

namespace Tests\Unit\Authentication;

use Banxa\Authentication\Authentication;
use JsonException;
use Tests\BaseTestCase;

/** @covers \Banxa\Authentication\Authentication::generateAuthToken */
class AuthenticationTest extends BaseTestCase
{
    private string $uri;
    private string $key;
    private string $secret;

    public function setUp(): void
    {
        parent::setUp();
        $this->uri = "foo/bar";
        $this->key = "accessKey";
        $this->secret = "accessKeySecret";
    }

    /**
     * @test
     * @throws JsonException
     */
    public function it_can_generate_a_auth_token()
    {
        $method = 'GET';
        $expected = "f4fb557cc803ebeef51b6062389b7143602fa0c076eb8542385a570cba09ef3a";

        $authentication = Authentication::make($this->key, $this->secret);
        $tokens = explode(":", $authentication->generateAuthToken($method, $this->uri, [], -1));

        $this->assertCount(3, $tokens);
        $this->assertEquals($this->key, $tokens[0]);
        $this->assertEquals($expected, $tokens[1]);
        $this->assertIsString($tokens[2]);
    }

    /**
     * @test
     * @throws JsonException
     */
    public function it_can_generate_a_auth_token_with_data()
    {
        $method = 'POST';
        $data = ["test" => "data"];
        $expected = "dc0327c28375f930d145cd2545e1fc68f40d008ffbdd80d4f807d4c20d3ef6d3";

        $authentication = Authentication::make($this->key, $this->secret);
        $tokens = explode(":", $authentication->generateAuthToken($method, $this->uri, $data, -1));

        $this->assertCount(3, $tokens);
        $this->assertEquals($this->key, $tokens[0]);
        $this->assertEquals($expected, $tokens[1]);
        $this->assertIsString($tokens[2]);
    }


}
