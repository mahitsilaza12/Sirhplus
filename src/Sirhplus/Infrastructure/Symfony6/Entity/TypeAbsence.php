<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class TypeAbsence
{
    use IdentityUuid;

   /**
    * @var string
    */
    #[ORM\Column(type: 'string')]
    private string $type;

   /**
    * @var string
    */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $color;

   /**
    * @var boolean
    */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $visibility = true;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $typeRights;

     /**
      * @var float
      */
    #[ORM\Column(type: 'decimal', nullable: true)]
    private float|null $rights;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $accumulationPeriod;

   /**
    * @var string
    */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $rightsRenewalDate;

   /**
    * @var string
    */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $accumulationFrequency;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $consumptionPeriod;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $methodOfReduction;

     /**
      * @var boolean
      */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $absence;

    /**
     * @var boolean
     */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $validation;


    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $postponement;

    /**
     * @var string
     */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $protected;

    /**
     * @var boolean
     */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $limitPerWeek;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $restrictionLimitPerWeek;

    #[ORM\ManyToOne(targetEntity: AbsencePlan::class)]
    private AbsencePlan|null $absencePlan;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company|null $company;
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return TypeAbsence
     */
    public function setType(string $type): TypeAbsence
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return TypeAbsence
     */
    public function setColor(string $color): TypeAbsence
    {
        $this->color = $color;

        return $this;
    }

    /**
    * @return boolean|null
    */
    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }
  
    /**
    * @param boolean $visibility
    * @return $this
    */
    public function setVisibility(?bool $visibility): self
    {
        $this->visibility = $visibility;
  
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeRights(): string
    {
        return $this->typeRights;
    }

    /**
     * @param string $typeRights
     *
     * @return TypeAbsence
     */
    public function setTypeRights(string $typeRights): TypeAbsence
    {
        $this->typeRights = $typeRights;

        return $this;
    }

      /**
     * @return float|null
     */
    public function getRights(): ?float
    {
        return $this->rights;
    }

    /**
     * @param float|null $rights
     */
    public function setRights(?float $rights): TypeAbsence
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccumulationPeriod(): string
    {
        return $this->accumulationPeriod;
    }

    /**
     * @param string $accumulationPeriod
     *
     * @return TypeAbsence
     */
    public function setAccumulationPeriod(string $accumulationPeriod): TypeAbsence
    {
        $this->accumulationPeriod = $accumulationPeriod;

        return $this;
    }
        
    /**
     * @return string
     */
    public function getRightsRenewalDate(): string
    {
        return $this->rightsRenewalDate;
    }

    /**
     * @param string $rightsRenewalDate
     *
     * @return TypeAbsence
     */
    public function setRightsRenewalDate(string $rightsRenewalDate): TypeAbsence
    {
        $this->rightsRenewalDate = $rightsRenewalDate;

        return $this;
    }
            
    /**
     * @return string
     */
    public function getAccumulationFrequency(): string
    {
        return $this->accumulationFrequency;
    }

    /**
     * @param string $accumulationFrequency
     *
     * @return TypeAbsence
     */
    public function setAccumulationFrequency(string $accumulationFrequency): TypeAbsence
    {
        $this->accumulationFrequency = $accumulationFrequency;

        return $this;
    }

    /**
     * @return string
     */
    public function getConsumptionPeriod(): string
    {
        return $this->consumptionPeriod;
    }

    /**
     * @param string $consumptionPeriod
     *
     * @return TypeAbsence
     */
    public function setConsumptionPeriod(string $consumptionPeriod): TypeAbsence
    {
        $this->consumptionPeriod = $consumptionPeriod;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethodOfReduction(): string
    {
        return $this->methodOfReduction;
    }

    /**
     * @param string $methodOfReduction
     *
     * @return TypeAbsence
     */
    public function setMethodOfReduction(string $methodOfReduction): TypeAbsence
    {
        $this->methodOfReduction = $methodOfReduction;

        return $this;
    }
    
    /**
    * @return boolean|null
    */
    public function isAbsence(): ?bool
    {
        return $this->absence;
    }
  
    /**
    * @param boolean $absence
    * @return $this
    */
    public function setAbsence(?bool $absence): self
    {
        $this->absence = $absence;
  
        return $this;
    }


    /**
    * @return boolean|null
    */
    public function isValidation(): ?bool
    {
        return $this->validation;
    }
  
    /**
    * @param boolean $validation
    * @return $this
    */
    public function setValidation(?bool $validation): self
    {
        $this->validation = $validation;
  
        return $this;
    }

    /**
     * @return string
     */
    public function getPostponement(): string
    {
        return $this->postponement;
    }

    /**
     * @param string $postponement
     *
     * @return TypeAbsence
     */
    public function setPostponement(string $postponement): TypeAbsence
    {
        $this->postponement = $postponement;

        return $this;
    }

    /**
    * @return boolean|null
    */
    public function isLimitPerWeek(): ?bool
    {
        return $this->limitPerWeek;
    }
  
    /**
    * @param boolean $limitPerWeek
    * @return $this
    */
    public function setLimitPerWeek(?bool $limitPerWeek): self
    {
        $this->limitPerWeek = $limitPerWeek;
  
        return $this;
    }

        /**
     * @return string
     */
    public function getRestrictionLimitPerWeek(): string
    {
        return $this->restrictionLimitPerWeek;
    }

    /**
     * @param string $restrictionLimitPerWeek
     *
     * @return TypeAbsence
     */
    public function setRestrictionLimitPerWeek(string $restrictionLimitPerWeek): TypeAbsence
    {
        $this->restrictionLimitPerWeek = $restrictionLimitPerWeek;

        return $this;
    }

      /**
      * @return AbsencePlan
      */
      public function getAbsencePlan(): AbsencePlan
      {
          return $this->absencePlan;
      }

    /**
     * @param AbsencePlan $absencePlan
    */
    public function setAbsencePlan(?AbsencePlan $absencePlan): void
    {
        $this->absencePlan = $absencePlan;
    }

    /**
     * @return Company
    */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
    */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }

    /**
     * @return bool
     */
    public function isProtected(): bool
    {
        return $this->protected;
    }

    /**
    * @param boolean $protected
    * @return $this
    */
    public function setProtected(?bool $protected): self
    {
        $this->protected = $protected;
  
        return $this;
    }
}