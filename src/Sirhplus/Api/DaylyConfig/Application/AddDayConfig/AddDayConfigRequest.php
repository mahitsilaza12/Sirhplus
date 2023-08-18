<?php

namespace Sirhplus\Api\DaylyConfig\Application\AddDayConfig;

use DateTime;
use Sirhplus\Api\DaylyConfig\Application\DayConfigRequest;

/**
 * class AddDayConfigRequest
 */
final class AddDayConfigRequest extends DayConfigRequest
{
    public string $uuid;
    /**
     * @param array $dayConfig
     * @param string $uuid
     */
    public function __construct(
        public array $dayConfig = [],
         string $uuid = '' ,
    ) {
        parent::__construct($dayConfig, $uuid);
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