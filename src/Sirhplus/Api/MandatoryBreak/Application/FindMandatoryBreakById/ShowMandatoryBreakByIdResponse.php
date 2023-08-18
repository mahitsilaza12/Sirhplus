<?php

namespace Sirhplus\Api\MandatoryBreak\Application\FindMandatoryBreakById;

use Sirhplus\Shared\Service\Response;

/**
 * class ShowMandatoryBreakByIdResponse
 */
final class ShowMandatoryBreakByIdResponse implements Response
{
       /**
     * @var array
     */
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

    /**
     * @return void
     */
    public function mapping(): void
    {
        $this->data = [
            'MandatoryBreak' => [
                'uuid' => $this->object->getId()->toRfc4122(),
                'name' => $this->object->getName(),
                'workingTimes' => $this->object->getWorkingTimes(),
                'pause' => $this->object->getPause(),
            ]
        ];
    }
}