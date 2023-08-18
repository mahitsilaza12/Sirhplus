<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class MandatoryBreak
{
    use IdentityUuid;

    #[ORM\Column(type: 'string', unique: true)]
    private string $name;

    #[ORM\Column(type: 'string',length: 5, nullable: true)]
    private string $workingTimes;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private string $pause;

    #[ORM\ManyToOne(targetEntity: HourlyRegime::class)]
    private HourlyRegime $hourlyRegime;

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
    public function setName(string $name): MandatoryBreak
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkingTimes(): string
    {
        return $this->workingTimes;
    }

    /**
     * @param string $workingTimes
     */
    public function setWorkingTimes(string $workingTimes): MandatoryBreak
    {
        $this->workingTimes = $workingTimes;

        return $this;
    }


    /**
     * @return string
     */
    public function getPause(): string
    {
        return $this->pause;
    }

    /**
     * @param string $pause
     */
    public function setPause(string $pause): MandatoryBreak
    {
        $this->pause = $pause;

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