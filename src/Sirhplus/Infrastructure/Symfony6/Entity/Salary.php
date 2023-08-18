<?php

namespace Symfony6\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sirhplus\Api\Salary\Infrastructure\Doctrine\SalaryRepository;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
class Salary
{
    use IdentityUuid;

    /**
     * @var \DateTime
     */
    #[ORM\Column(type: 'datetime')]
    private \DateTime $hiringDate;

    /**
     *
     * @var bool $status
     */
    #[ORM\Column(type: 'boolean')]
    private bool $status = true;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $logo;

    #[ORM\ManyToOne(targetEntity: Site::class)]
    private Site|null $site;

    #[ORM\ManyToOne(targetEntity: AbsencePlan::class)]
    private AbsencePlan|null $absencePlan;

    #[ORM\ManyToOne(targetEntity: Crew::class)]
    private Crew|null $crew;

    #[ORM\ManyToOne(targetEntity: Functions::class)]
    private Functions|null $function;

    #[ORM\ManyToOne(targetEntity: HourlyRegime::class)]
    private HourlyRegime|null $hourlyRegime;

    #[ORM\OneToMany(mappedBy: 'salary', targetEntity: User::class)]
    private Collection $user;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private Team|null $team;

    public function __construct()
    {
        $this->hiringDate = new \DateTime();
        $this->team = null;
    }

    /**
     * @return \DateTime
     */
    public function getHiringDate(): \DateTime
    {
        return $this->hiringDate;
    }

    /**
     * @param \DateTime $hiringDate
     */
    public function setHiringDate(\DateTime $hiringDate): self
    {
        $this->hiringDate = $hiringDate;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     * @return $this
     */
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     *
     * @return Site|null
     */
    public function getSite(): ?Site
    {
        return $this->site;
    }

   /**
    * @param Site $site
    * @return $this
    */
    public function setSite(Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return AbsencePlan|null
     */
    public function getAbsencePlan(): ?AbsencePlan
    {
        return $this->absencePlan;
    }

    /**
     * @param AbsencePlan|null $absencePlan
     * @return $this
     */
    public function setAbsencePlan(?AbsencePlan $absencePlan): self
    {
        $this->absencePlan = $absencePlan;

        return $this;
    }

    /**
     * @return Crew|null
     */
    public function getCrew(): ?Crew
    {
        return $this->crew;
    }

    /**
     * @param Crew|null $crew
     * @return $this
     */
    public function setCrew(?Crew $crew): self
    {
        $this->crew = $crew;

        return $this;
    }

    /**
     * @return Functions|null $functions
     */
    public function getFunctions(): ?Functions
    {
        return $this->function;
    }

    /**
     * @param Functions|null $function
     * @return $this
     */
    public function setFunctions(?Functions $function): self
    {
        $this->function = $function;

        return $this;
    }

    /**
     * @return HourlyRegime|null
     */
    public function getHourlyRegime(): ?HourlyRegime
    {
        return $this->hourlyRegime;
    }

    /**
     * @param HourlyRegime|null $hourlyRegime
     * @return $this
     */
    public function setHourlyRegime(?HourlyRegime $hourlyRegime): self
    {
        $this->hourlyRegime = $hourlyRegime;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    /**
     * @param Team|null $team
     * @return $this
     */
    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
