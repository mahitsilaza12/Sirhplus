<?php

namespace Sirhplus\Api\MandatoryBreak\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class EditMandatoryBreakModel
 */
final class EditMandatoryBreakModel extends ValueObject implements Request
{

    /**
     * @param string $name
     * @param string $workingTimes
     * @param string $pause
     * @param string $uuid
     */
    public function __construct(
        public string $name = '',
        public string $workingTimes = '',
        public string $pause = '',
        public string $uuid = '',
    )
    {
    }

     /**
     * @param string $uuid
     * @return EditMandatoryBreakRequest
     */
    public function setId(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @param Request $request
     * @return EditMandatoryBreakModel
     */
    public static function create(Request $request): EditMandatoryBreakModel
    {
        return new self(
            $request->name,
            $request->workingTimes,
            $request->pause,
            $request->uuid
        );
    }
}