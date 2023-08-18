<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

/**
 * class CompanyIdentificationModel
 */
final class CompanyIdentificationModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $siren
     * @param string $siret
     * @param string $tva
     * @param string $rcs
     */
    public function __construct(
        private string $siren,
        private string $siret,
        private string $tva,
        private string $rcs,
        private CompanyActivityModel $activityModel,
        private CollectiveAgreementModel $collectiveAgreementModel,
        private CompanyOrganismModel $companyOrganismModel
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->siren,
            $request->siret,
            $request->tva,
            $request->rcs,
            CompanyActivityModel::create($request->activity),
            CollectiveAgreementModel::create($request->collectiveAgreement),
            CompanyOrganismModel::create($request->organism),
        );
    }

    /**
     * @return string
     */
    public function siren(): string
    {
        return $this->siren;
    }

    /**
     * @return string
     */
    public function siret(): string
    {
        return $this->siret;
    }

    /**
     * @return string
     */
    public function tva(): string
    {
        return $this->tva;
    }

    /**
     * @return string
     */
    public function rcs(): string
    {
        return $this->rcs;
    }

    /**
     * @return CompanyActivityModel
     */
    public function activity(): CompanyActivityModel
    {
        return $this->activityModel;
    }

    /**
     * @return CollectiveAgreementModel
     */
    public function collectiveAgreement(): CollectiveAgreementModel
    {
        return $this->collectiveAgreementModel;
    }

    /**
     * @return CompanyOrganismModel
     */
    public function organism(): CompanyOrganismModel
    {
        return $this->companyOrganismModel;
    }
}