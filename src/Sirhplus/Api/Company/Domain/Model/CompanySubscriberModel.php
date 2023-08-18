<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

/**
 * class CompanySubscriberModel
 */
final class CompanySubscriberModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $subscriptionUuid
     */
    public function __construct(public string $subscriptionUuid) {
    }
    
    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->subscriptionUuid
        );
    }
}
