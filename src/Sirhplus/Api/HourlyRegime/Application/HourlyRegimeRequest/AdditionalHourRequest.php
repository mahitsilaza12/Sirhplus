<?php

namespace Sirhplus\Api\HourlyRegime\Application\HourlyRegimeRequest;

use Sirhplus\Shared\Service\Request;

/**
 * class AdditionalHourRequest
 */
final class AdditionalHourRequest implements Request
{

  /**
   * @param string $name
   */
    public function __construct(
        public string $name = '',
        public string $companyId = ''
    ) {

    }
}