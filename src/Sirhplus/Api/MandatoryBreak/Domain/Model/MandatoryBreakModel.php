<?php

namespace Sirhplus\Api\MandatoryBreak\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class MandatoryBreakModel
 */
abstract class MandatoryBreakModel extends ValueObject implements Request
{

    /**
    * Undocumented function
    *
    * @param string $name
    * @param string $workingTimes
    * @param string $pause
    */
    public function __construct(
        public string $name = '',
        public string $workingTimes = '',
        public string $pause = '',
        public string $uuid = '',
    ) {
    }

    /**
     * @param Request $request
     * @return MandatoryBreakModel
     */
    public abstract static function create(Request $request): MandatoryBreakModel;
}