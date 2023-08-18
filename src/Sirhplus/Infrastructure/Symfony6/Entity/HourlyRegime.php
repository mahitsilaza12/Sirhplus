<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class HourlyRegime
{
    use IdentityUuid;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $accountAdditionalHour = true;

    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $frequency;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $limite = true;

    #[ORM\Column(type: 'decimal', nullable: true)]
    private string|null $limitDay;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool|null $calculation;

    #[ORM\Column(type: 'decimal', nullable: true)]
    private float|null $dayCalculation;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company|null $company;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): HourlyRegime
    {
        $this->name = $name;

        return $this;
    }
    
        /**
      * @return boolean|null
      */
      public function isAccountAdditionalHour(): ?bool
      {
          return $this->accountAdditionalHour;
      }
  
      /**
       * @param boolean $accountAdditionalHour
       * @return $this
       */
      public function setAccountAdditionalHour(bool $accountAdditionalHour): self
      {
          $this->accountAdditionalHour = $accountAdditionalHour;
  
          return $this;
      }

    /**
     * @return string|null
     */
    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    /**
     * @param string|null $frequency
     */
    public function setFrequency(?string $frequency): HourlyRegime
    {
        $this->frequency = $frequency;

        return $this;
    }

       /**
      * @return boolean|null
      */
      public function isLimite(): ?bool
      {
          return $this->limite;
      }
  
      /**
       * @param boolean|null $limite
       * @return $this
       */
      public function setLimite(?bool $limite): self
      {
          $this->limite = $limite;
  
          return $this;
      }

    /**
     * @return float|null
     */
    public function getLimitDay(): ?float
    {
        return $this->limitDay;
    }

    /**
     * @param float|null $limitDay
     */
    public function setLimitDay(?float $limitDay): HourlyRegime
    {
        $this->limitDay = $limitDay;

        return $this;
    }

       /**
      * @return boolean|null
      */
      public function isCalculation(): ?bool
      {
          return $this->calculation;
      }
  
      /**
       * @param boolean $calculation
       * @return $this
       */
      public function setCalculation(?bool $calculation): self
      {
          $this->calculation = $calculation;
  
          return $this;
      }

    /**
     * @return float|null
     */
    public function getDayCalculation(): ?float
    {
        return $this->dayCalculation;
    }

    /**
     * @param float|null $dayCalculation
     */
    public function setDayCalculation(?float $dayCalculation): HourlyRegime
    {
        $this->dayCalculation = $dayCalculation;

        return $this;
    }
    /**
     *
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;
        
        return $this;
    }
}
