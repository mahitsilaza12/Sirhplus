<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class DaylyConfig
{
    use IdentityUuid;

    #[ORM\Column(type: 'string', nullable: true)]
    private string $day;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private string $startTime;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private string $endTIme;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private string $startBreakTime;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private string $endBreakTime;

    #[ORM\Column(type: 'string', length: 6, nullable: true)]
    private string $agreedWorkingHours;

    #[ORM\Column(type: 'string', nullable: true)]
    private string $type;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: HourlyRegime::class)]
    private HourlyRegime $hourlyRegime;

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime(string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndTIme(): string
    {
        return $this->endTIme;
    }

    /**
     * @param string $endTIme
     */
    public function setEndTIme(string $endTIme): self
    {
        $this->endTIme = $endTIme;

        return $this;
    }

     /**
     * @return string
     */
    public function getStartBreakTime(): string
    {
        return $this->startBreakTime;
    }

    /**
     * @param string $startBreakTime
     */
    public function setStartBreakTime(string $startBreakTime): self
    {
        $this->startBreakTime = $startBreakTime;

        return $this;
    }


     /**
     * @return string
     */
    public function getEndBreakTime(): string
    {
        return $this->endBreakTime;
    }

    /**
     * @param string $endBreakTime
     */
    public function setEndBreakTime(string $endBreakTime): self
    {
        $this->endBreakTime = $endBreakTime;

        return $this;
    }

      /**
     * @return string
     */
    public function getAgreedWorkingHours(): string
    {
        return $this->agreedWorkingHours;
    }

    /**
     * @param string $agreedWorkingHours
     */
    public function setAgreedWorkingHours(string $agreedWorkingHours): self
    {
        $this->agreedWorkingHours = $agreedWorkingHours;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

         /**
      * @return boolean|null
      */
      public function isStatus(): ?bool
      {
          return $this->status;
      }
  
      /**
       * @param boolean $status
       * @return $this
       */
      public function setStatus(bool $status): self
      {
          $this->status = $status;
  
          return $this;
      }

      
      /**
      * @return HourlyRegime
      */
      public function getHourlyRegime(): HourlyRegime
      {
          return $this->hourlyRegime;
      }

      /**
      * @param HourlyRegime $hourlyRegime
      */
      public function setHourlyRegime(HourlyRegime $hourlyRegime): void
      {
          $this->hourlyRegime = $hourlyRegime;
      }
}