<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sirhplus\Api\Functions\Infrastructure\Doctrine\FunctionRepository;

#[ORM\Entity(repositoryClass: FunctionRepository::class)]
class Functions
{
    use IdentityUuid;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: false)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company $company;

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
     */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }
}
