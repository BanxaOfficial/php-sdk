<?php

declare(strict_types=1);

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\OptionalOrderParameters;
use PHPUnit\Framework\TestCase;

/** @covers \Banxa\Domains\Orders\Builders\OptionalOrderParameters */
class OptionalOrderParametersTest extends TestCase
{

    /** @test */
    public function it_can_create_a_optional_order_parameters_object()
    {
        $optionalOrderParameters = OptionalOrderParameters::create(
            $sourceAddress = "Testing",
            $sourceAddressTag = "MEMO",
            $email = "test@email.com",
            $mobile = '0411111111',
        );
        $this->assertInstanceOf(OptionalOrderParameters::class, $optionalOrderParameters);
        $this->assertEquals($sourceAddress, $optionalOrderParameters->getSourceAddress());
        $this->assertEquals($sourceAddressTag, $optionalOrderParameters->getSourceAddressTag());
        $this->assertEquals($email, $optionalOrderParameters->getEmail());
        $this->assertEquals($mobile, $optionalOrderParameters->getMobile());
    }

    /** @test */
    public function it_can_create_a_optional_order_parameters_object_with_some_variables()
    {
        $optionalOrderParameters = OptionalOrderParameters::create(
            $sourceAddress = "Testing",
            $sourceAddressTag = null,
            $email = "test@email.com",
            $mobile = null,
        );
        $this->assertInstanceOf(OptionalOrderParameters::class, $optionalOrderParameters);

        $this->assertIsArray($optionalOrderParameters->toArray());


        $this->assertEquals($sourceAddress, $optionalOrderParameters->getSourceAddress());
        $this->assertEquals($sourceAddress, $optionalOrderParameters->toArray()['source_address']);
        $this->assertEquals($sourceAddressTag, $optionalOrderParameters->getSourceAddressTag());
        $this->assertEquals($email, $optionalOrderParameters->getEmail());
        $this->assertEquals($email, $optionalOrderParameters->toArray()['email']);
        $this->assertEquals($mobile, $optionalOrderParameters->getMobile());
    }


    /** @test */
    public function it_can_add_optional_parameters_via_chaining()
    {
        $optionalOrderParameters = new OptionalOrderParameters();
        $optionalOrderParameters->setSourceAddress($sourceAddress = "Testing")
            ->setSourceAddressTag($sourceAddressTag = "MEMO")
            ->setEmail($email = "test@email.com")
            ->setMobile($mobile = '0411111111');

        $this->assertIsObject($optionalOrderParameters);
        $this->assertInstanceOf(OptionalOrderParameters::class, $optionalOrderParameters);
        $this->assertEquals($sourceAddress, $optionalOrderParameters->getSourceAddress());
        $this->assertEquals($sourceAddressTag, $optionalOrderParameters->getSourceAddressTag());
        $this->assertEquals($email, $optionalOrderParameters->getEmail());
        $this->assertEquals($mobile, $optionalOrderParameters->getMobile());
    }

}
