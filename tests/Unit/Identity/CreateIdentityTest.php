<?php

namespace Tests\Unit\Identity;

use Banxa\Domains\Identity\Builders\CustomerDetail;
use Banxa\Domains\Identity\Builders\CustomerIdentity;
use Banxa\Domains\Identity\Builders\IdentityDocument;
use Banxa\Domains\Identity\Builders\IdentityDocumentCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingProvider;
use Banxa\Domains\Identity\Builders\ResidentialAddress;
use Banxa\Domains\Identity\CreateIdentity;
use Banxa\Exceptions\Identity\DocumentTypeValidationException;
use Banxa\Exceptions\Identity\InvalidIdentityDocumentException;
use Banxa\Exceptions\Identity\InvalidIdentityProviderException;
use Banxa\Exceptions\Identity\InvalidOrMissingImageLinkProtocolException;
use Banxa\Exceptions\Identity\ResidentialAddressValidationException;
use JsonException;
use Tests\BaseTestCase;
use Tests\fixtures\Identity\CreateIdentityResponse;

/** @covers \Banxa\Domains\Identity\CreateIdentity::buildPayload::create */
class CreateIdentityTest extends BaseTestCase
{
    private CreateIdentity $createIdentity;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockHttpClient(CreateIdentityResponse::success());
        $this->createIdentity = (new CreateIdentity($this->httpClientMock));
    }


    /** @test
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws JsonException
     * @throws ResidentialAddressValidationException
     */
    public function it_cannot_create_identity_with_invalid_country_code()
    {
        $this->expectException(ResidentialAddressValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Country must be a ISO 3166 two letter country code');
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('foobar', 'baz')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([IdentityDocument::create(IdentityDocument::DOCUMENT_TYPE_PASSPORT, ['https://www.orimi.com/pdf-test.pdf'], 'BTCBaz007')]),
            ResidentialAddress::create('FIZBUZ')
        );
    }

    /** @test
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws JsonException
     */
    public function it_cannot_create_identity_with_invalid_document_type()
    {
        $this->expectException(DocumentTypeValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage(sprintf(DocumentTypeValidationException::INVALID_DOCUMENT_TYPE, 'FOOBAR', implode(' ', IdentityDocument::DOCUMENT_TYPES)));
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('foobar', 'baz')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([IdentityDocument::create('FOOBAR', ['https://www.orimi.com/pdf-test.pdf'], 'BTCBaz007')]),
        );
    }

    /** @test
     * @throws JsonException
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     */
    public function it_rejects_image_links_with_invalid_protocol()
    {
        $invalidUrl = 'invalid.url';
        $this->expectException(InvalidOrMissingImageLinkProtocolException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage(sprintf(InvalidOrMissingImageLinkProtocolException::EXCEPTION, $invalidUrl));
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('sumsub', 'bar')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([
                IdentityDocument::create(IdentityDocument::DOCUMENT_TYPE_DRIVING_LICENCE, [
                    'https://valid.url',
                    $invalidUrl
                ], 'BTCBaz007')
            ]),
        );
    }

    /** @test
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws JsonException
     * @throws ResidentialAddressValidationException
     */
    public function it_rejects_when_image_links_for_document_type_are_missing()
    {
        $this->expectException(DocumentTypeValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage(sprintf(DocumentTypeValidationException::MISSING_IMAGE_LINKS, IdentityDocument::DOCUMENT_TYPE_PASSPORT));
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('sumsub', 'bar')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([IdentityDocument::create(IdentityDocument::DOCUMENT_TYPE_PASSPORT, [], 'BTCBaz007')]),
        );
    }

    /** @test
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws JsonException
     */
    public function it_rejects_more_then_two_image_links_for_document_type_passport()
    {
        $this->mockHttpClient("");
        $this->expectException(DocumentTypeValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage(sprintf(DocumentTypeValidationException::TOO_MANY_IMAGES_EXCEPTION_FOR_DOCUMENT_TYPE, IdentityDocument::DOCUMENT_TYPE_PASSPORT));
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('sumsub', 'bar')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([
                IdentityDocument::create(IdentityDocument::DOCUMENT_TYPE_PASSPORT, [
                    'https://foo.bar',
                    'https://fiz.buz'
                ], 'BTCBaz007')
            ]),
        );
    }

    /** @test
     * @throws DocumentTypeValidationException
     * @throws InvalidIdentityDocumentException
     * @throws InvalidIdentityProviderException
     * @throws InvalidOrMissingImageLinkProtocolException
     * @throws JsonException
     */
    public function it_rejects_document_number_if_not_required_for_document_type()
    {
        $this->expectException(DocumentTypeValidationException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage(sprintf(DocumentTypeValidationException::DOCUMENT_NUMBER_NOT_REQUIRED_FOR_DOCUMENT_TYPE,
            IdentityDocument::DOCUMENT_TYPE_SELFIE,
            implode(' ', [
                IdentityDocument::DOCUMENT_TYPE_PASSPORT,
                IdentityDocument::DOCUMENT_TYPE_DRIVING_LICENCE,
                IdentityDocument::DOCUMENT_TYPE_IDENTIFICATION
            ])
        ));
        $this->createIdentity->create(
            IdentitySharingCollection::create([IdentitySharingProvider::create('sumsub', 'bar')]),
            CustomerDetail::create('foobar', '123456789', 'foo@bar.baz'),
            CustomerIdentity::create('FooBarBaz', 'FizBuz', '2012-01-01'),
            IdentityDocumentCollection::create([
                IdentityDocument::create(IdentityDocument::DOCUMENT_TYPE_SELFIE, [
                    'https://foo.bar',
                ], 'BTCBaz007')
            ]),
        );
    }

    /** @test
     * @throws InvalidIdentityDocumentException
     * @throws InvalidOrMissingImageLinkProtocolException
     */
    public function it_rejects_invalid_input_type_for_document_collection()
    {
        $this->expectException(InvalidIdentityDocumentException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage((new InvalidIdentityDocumentException())->getMessage());
        IdentityDocumentCollection::create(['foobar']);
    }

    /**
     * @return void
     * @test
     * @throws InvalidIdentityProviderException
     */
    public function it_rejects_invalid_input_type_for_identity_provider(): void
    {
        $this->expectException(InvalidIdentityProviderException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage((new InvalidIdentityProviderException())->getMessage());
        IdentitySharingCollection::create(['foobar']);
    }
}