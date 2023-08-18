<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class CompanyIdentify
{
    use IdentityUuid;

    #[ORM\Column(type: 'string')]
    private string $siren;

    #[ORM\Column(type: 'string')]
    private string $siret;

    #[ORM\Column(type: 'string')]
    private string $tva;

    #[ORM\Column(type: 'string')]
    private string $rcs;

    #[ORM\Column(type: 'string')]
    private string $sector;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\Column(type: 'string')]
    private string $details;

    #[ORM\Column(type: 'string')]
    private string $idcc;

    #[ORM\Column(type: 'string')]
    private string $provisioning;

    #[ORM\Column(type: 'string')]
    private string $healthComplementary;

    #[ORM\Column(type: 'string')]
    private string $pensionFund;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getSiren(): string
    {
        return $this->siren;
    }

    /**
     * @param string $siren
     */
    public function setSiren(string $siren): CompanyIdentify
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiret(): string
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     */
    public function setSiret(string $siret): CompanyIdentify
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return string
     */
    public function getTva(): string
    {
        return $this->tva;
    }

    /**
     * @param string $tva
     */
    public function setTva(string $tva): CompanyIdentify
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * @return string
     */
    public function getRcs(): string
    {
        return $this->rcs;
    }

    /**
     * @param string $rcs
     */
    public function setRcs(string $rcs): CompanyIdentify
    {
        $this->rcs = $rcs;

        return $this;
    }

    /**
     * @return string
     */
    public function getSector(): string
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setSector(string $sector): CompanyIdentify
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): CompanyIdentify
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @param string $details
     */
    public function setDetails(string $details): CompanyIdentify
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdcc(): string
    {
        return $this->idcc;
    }

    /**
     * @param string $idcc
     */
    public function setIdcc(string $idcc): CompanyIdentify
    {
        $this->idcc = $idcc;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvisioning(): string
    {
        return $this->provisioning;
    }

    /**
     * @param string $provisioning
     */
    public function setProvisioning(string $provisioning): CompanyIdentify
    {
        $this->provisioning = $provisioning;

        return $this;
    }

    /**
     * @return string
     */
    public function getHealthComplementary(): string
    {
        return $this->healthComplementary;
    }

    /**
     * @param string $healthComplementary
     */
    public function setHealthComplementary(string $healthComplementary): CompanyIdentify
    {
        $this->healthComplementary = $healthComplementary;

        return $this;
    }

    /**
     * @return string
     */
    public function getPensionFund(): string
    {
        return $this->pensionFund;
    }

    /**
     * @param string $pensionFund
     */
    public function setPensionFund(string $pensionFund): CompanyIdentify
    {
        $this->pensionFund = $pensionFund;

        return $this;
    }
}
