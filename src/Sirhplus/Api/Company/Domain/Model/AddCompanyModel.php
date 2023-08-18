<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Service\Request;

/**
 * class AddCompanyModel
 */
final class AddCompanyModel extends AbstractCompanyModel
{
    /**
     * @param GeneralCompanyModel $general
     * @param CompanyIdentificationModel $identification
     * @param CompanyOthersModel $others
     */
    public function __construct(
        GeneralCompanyModel $general,
        CompanyIdentificationModel $identification,
        CompanyOthersModel $others
    ) {
        parent::__construct($general, $identification, $others);
    }

    /**
     * @param Request $request
     * @return AbstractCompanyModel
     * @throws \Exception
     */
    public static function create(Request $request): AbstractCompanyModel
    {
        return new self(
            GeneralCompanyModel::create($request->general),
            CompanyIdentificationModel::create($request->identification),
            CompanyOthersModel::create($request->others)
        );
    }
}
