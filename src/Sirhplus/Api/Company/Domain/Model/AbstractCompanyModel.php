<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class CompanyModel
 */
abstract class AbstractCompanyModel extends ValueObject implements Request
{
    /**
     * @param GeneralCompanyModel $general
     * @param CompanyIdentificationModel $identification
     * @param CompanyOthersModel $others
     */
    public function __construct(
        private GeneralCompanyModel $general,
        private CompanyIdentificationModel $identification,
        private CompanyOthersModel $others
    ) {
    }

    /**
     * @param Request $request
     * @return AbstractCompanyModel
     */
    public abstract static function create(Request $request) :AbstractCompanyModel;

    /**
     * @return GeneralCompanyModel
     */
    public function general(): GeneralCompanyModel
    {
        return $this->general;
    }

    /**
     * @return CompanyIdentificationModel
     */
    public function identification(): CompanyIdentificationModel
    {
        return $this->identification;
    }

    /**
     * @return CompanyOthersModel
     */
    public function others(): CompanyOthersModel
    {
        return $this->others;
    }
}
