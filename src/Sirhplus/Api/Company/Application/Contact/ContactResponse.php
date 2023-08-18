<?php

namespace Sirhplus\Api\Company\Application\Contact;

use Sirhplus\Shared\Service\Response;

final class ContactResponse implements Response
{
    public function __construct(public readonly array $object)
    {
    }

    public function getContent(): array
    {
        return $this->object;
    }
}
