<?php

namespace Sirhplus\Api\AbsencePlan\Application\EditAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\AbsencePlanRequest;

/**
 * class EditAbsencePlanRequest
 */
final class EditAbsencePlanRequest extends AbsencePlanRequest
{

      /** @var string  */
      private string $uuid;

    /**
     * @param string $name
     */
    public function __construct(public string $name = '')
    {
        parent::__construct($name);
    }

     /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return EditAbsencePlanRequest
     */
    public function setUuid(string $uuid) :EditAbsencePlanRequest
    {
        $this->uuid = $uuid;

        return $this;
    }
}