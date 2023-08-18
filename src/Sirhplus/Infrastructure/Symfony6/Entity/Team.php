<?php

namespace Symfony6\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Infrastructure\Doctrine\TeamRepository;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    use IdentityUuid;

    #[ORM\Column(type: 'string', unique: true, nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company $company;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'users')]
    private Collection|null $users;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return $this
     */
    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getUsers(): ?Collection
    {
        return $this->users;
    }

    /**
     * @param User|null $user
     *
     * @return $this
     */
    public function addUser(?User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users = $user;
        }

        return $this;
    }
}
