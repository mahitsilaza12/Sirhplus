<?php

namespace Sirhplus\Api\MandatoryBreak\Domain\Model;

use Sirhplus\Shared\Service\Request;

/**
 * class AddMandatoryBreakModel
 */
final class AddMandatoryBreakModel extends MandatoryBreakModel
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
        parent:: __construct($name, $workingTimes, $pause, $uuid);
    }

    /**
     * @param Request $request
     * @return AddMandatoryBreakModel
     */
    public static function create(Request $request): AddMandatoryBreakModel
    {
        return new self(
            $request->name,
            $request->workingTimes,
            $request->pause,
            $request->uuid
        );
    }
}