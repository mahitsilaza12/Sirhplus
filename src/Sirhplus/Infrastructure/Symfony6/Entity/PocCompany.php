<?php

namespace Symfony6\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Table(name: 'poc_company')]
#[ORM\Entity()]
class PocCompany
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 30)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: PocCompany::class)]
    private Collection $children;

    #[ORM\ManyToOne(targetEntity: PocCompany::class, inversedBy: 'children')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    private PocCompany|null $parent = null;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection|PocCompany[]
     */
    public function getChildrens(): Collection
    {
        return $this->children;
    }

    /**
     * @param PocCompany $children
     *
     * @return $this
     */
    public function addChildren(PocCompany $children): self
    {
        if (!$this->children->contains($children)) {
            $this->children[] = $children;
        }

        return $this;
    }

    /**
     * @param PocCompany $children
     *
     * @return $this
     */
    public function removeChildren(PocCompany $children): self
    {
        if ($this->children->contains($children)) {
            $this->children->removeElement($children);
        }

        return $this;
    }

    /**
     * @return PocCompany|null
     */
    public function getParent(): ?PocCompany
    {
        return $this->parent;
    }

    /**
     * @param PocCompany|null $parent
     *
     * @return $this
     */
    public function setParent(?PocCompany $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
