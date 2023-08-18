<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Find;

use Sirhplus\Shared\Service\Response;

final class FindSiteResponse implements Response
{
    /** @var array  */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->data = [];
        $this->mapping();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }

    private function mapping(): void
    {
        $object = $this->object;
        $this->data = [
            'id' => $object->getId()->toRfc4122(),
            'name' => $object->getName(),
        ];
    }
}
