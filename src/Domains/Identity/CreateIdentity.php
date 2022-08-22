<?php

namespace Banxa\Domains\Identity;

use Banxa\Domains\Domain;
use Banxa\Domains\Identity\Builders\CustomerDetail;
use Banxa\Domains\Identity\Builders\CustomerIdentity;
use Banxa\Domains\Identity\Builders\IdentityDocumentCollection;
use Banxa\Domains\Identity\Builders\IdentitySharingCollection;
use Banxa\Domains\Identity\Builders\ResidentialAddress;
use Banxa\Library\KeyConstants;

class CreateIdentity extends Domain
{
    private string $path = 'api/identities';

    /**
     * @param IdentitySharingCollection $identitySharingCollection
     * @param CustomerDetail $customerDetails
     * @param ResidentialAddress $residentialAddress
     * @param CustomerIdentity $customerIdentity
     * @param IdentityDocumentCollection|null $identityDocumentCollection
     * @return array
     */
    protected function buildPayload(
        IdentitySharingCollection $identitySharingCollection,
        CustomerDetail $customerDetails,
        ResidentialAddress $residentialAddress,
        CustomerIdentity $customerIdentity,
        IdentityDocumentCollection|null $identityDocumentCollection,
    ): array {
        $payload = [
            KeyConstants::_ACCOUNT_REFERENCE => $customerDetails->getAccountReference(),
            KeyConstants::_MOBILE_NUMBER     => $customerDetails->getMobileNumber(),
            KeyConstants::_EMAIL             => $customerDetails->getEmailAddress(),
            KeyConstants::_CUSTOMER_IDENTITY => $customerIdentity->toArray(),
            KeyConstants::_IDENTITY_SHARING  => $identitySharingCollection->all()
        ];

        $payload[KeyConstants::_CUSTOMER_IDENTITY][KeyConstants::_RESIDENTIAL_ADDRESS] = $residentialAddress->toArray();

        if ($identityDocumentCollection instanceof IdentityDocumentCollection) {
            $payload[KeyConstants::_IDENTITY_DOCUMENTS] = $identityDocumentCollection->all();
        }
        return $payload;
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->path;
    }
}