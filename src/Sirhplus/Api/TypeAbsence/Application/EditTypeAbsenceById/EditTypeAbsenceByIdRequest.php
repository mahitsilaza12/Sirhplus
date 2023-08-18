<?php

namespace Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class EditTypeAbsenceByIdRequest
 */
final class EditTypeAbsenceByIdRequest extends ValueObject implements Request
{
    /**
     * @var string
     */
    public string $uuid;
    /**
     * @param string $type
     * @param string $color
     * @param boolean $visibility
     */
    public function __construct(
        public string $type = '',
        public string $color = '',
        public bool $visibility = false
    )
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

}