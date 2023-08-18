<?php

namespace Symfony6\Entity;
use Doctrine\ORM\Mapping as ORM;
use Sirhplus\Api\AbsencePlan\Infrastructure\Doctrine\AbsencePlanRepository;

#[ORM\Entity(repositoryClass: AbsencePlanRepository::class)]
class AbsencePlan
{
    use IdentityUuid;

    #[ORM\Column(type: 'string')]
    private string $name;

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
    public function setName(string $name): AbsencePlan
    {
        $this->name = $name;

        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company|null $company;

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