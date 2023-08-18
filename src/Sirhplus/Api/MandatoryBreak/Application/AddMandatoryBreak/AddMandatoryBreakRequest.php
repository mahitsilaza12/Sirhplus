<?php

namespace Sirhplus\Api\MandatoryBreak\Application\AddMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Application\AbstractMandatoryBreakRequest;

/**
 * class AddMandatoryBreakRequest
 */
final class AddMandatoryBreakRequest extends AbstractMandatoryBreakRequest
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
        public string $uuid = ''
    )
    {
        parent::__construct($name, $workingTimes, $pause, $uuid);
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function sethourlyBreak(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}