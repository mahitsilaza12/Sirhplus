<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Site
{
    use IdentityUuid;

    #[ORM\Column(type: 'string')]
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
    public function setName(string $name): Site
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
     *
     * @return $this
     */
    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
