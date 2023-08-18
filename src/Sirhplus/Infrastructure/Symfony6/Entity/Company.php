<?php

namespace Symfony6\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Sirhplus\Api\Company\Infrastructure\Doctrine\CompanyRepository;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    use IdentityUuid;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', nullable: false)]
    private string $name;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $logo;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $legalStructure;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $socialReason;

    /**
     * @var \DateTime
     */
    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    /**
     * @var float
     */
    #[ORM\Column(type: 'decimal', precision: 2)]
    private float $sales;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $address;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 5)]
    private string $postalCode;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $city;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $site;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $leadingStatus;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 250, nullable: true)]
    private string|null $schedule;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private string $assignment;

    /**
     * @var string $phoneNumber
     */
    #[ORM\Column(type: 'string', length: 15)]
    private string $phoneNumber;

    /**
     * @var string|null $type
     */
    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private string|null $type;

    /**
     * @var CompanyIdentify
     */
    #[ORM\OneToOne(targetEntity: CompanyIdentify::class, cascade: ["persist"])]
    private CompanyIdentify $identification;

    /**
     * @var Subscription|null
     */
    #[ORM\OneToOne(targetEntity: Subscription::class, cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: true)]
    private Subscription|null $subscription;

    /**
     * @var User|null
     */
    #[ORM\OneToOne(targetEntity: User::class, cascade: ["persist"])]
    private User|null $property;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $children;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'children')]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id')]
    private Company|null $parent = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $users;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->identification = new CompanyIdentify();
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
     */
    public function setLogo(?string $logo): Company
    {
        $this->logo = $logo;

        return $this;
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
    public function setName(string $name): Company
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLegalStructure(): string
    {
        return $this->legalStructure;
    }

    /**
     * @param string $legalStructure
     */
    public function setLegalStructure(string $legalStructure): Company
    {
        $this->legalStructure = $legalStructure;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocialReason(): string
    {
        return $this->socialReason;
    }

    /**
     * @param string $socialReason
     */
    public function setSocialReason(string $socialReason): Company
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): Company
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return float
     */
    public function getSales(): float
    {
        return $this->sales;
    }

    /**
     * @param float $sales
     */
    public function setSales(float $sales): Company
    {
        $this->sales = $sales;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;

        return $this;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): Company
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): Company
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): Company
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite(string $site): Company
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return CompanyIdentify
     */
    public function getIdentification(): CompanyIdentify
    {
        return $this->identification;
    }

    /**
     * @param CompanyIdentify $identification
     */
    public function setIdentification(CompanyIdentify $identification): Company
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeadingStatus(): string
    {
        return $this->leadingStatus;
    }

    /**
     * @param string $leadingStatus
     */
    public function setLeadingStatus(string $leadingStatus): Company
    {
        $this->leadingStatus = $leadingStatus;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    /**
     * @param string $schedule
     */
    public function setSchedule(string $schedule): Company
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return string
     */
    public function getAssignment(): string
    {
        return $this->assignment;
    }

    /**
     * @param string $assignment
     */
    public function setAssignment(string $assignment): Company
    {
        $this->assignment = $assignment;

        return $this;
    }

    /**
     * @return Subscription|null
     */
    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription|null $subscription
     *
     * @return $this
     */
    public function setSubscription(?Subscription $subscription): Company
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getProperty(): ?User
    {
        return $this->property;
    }

    /**
     * @param User|null $property
     * @return $this
     */
    public function setProperty(?User $property): self
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Company $children
     *
     * @return $this
     */
    public function addChildren(Company $children): self
    {
        if (!$this->children->contains($children)) {
            $this->children[] = $children;
        }

        return $this;
    }

    /**
     * @param Company $children
     *
     * @return $this
     */
    public function removeChildren(Company $children): self
    {
        if ($this->children->contains($children)) {
            $this->children->removeElement($children);
        }

        return $this;
    }

    /**
     * @return Company|null
     */
    public function getParent(): ?Company
    {
        return $this->parent;
    }

    /**
     * @param Company|null $parent
     *
     * @return $this
     */
    public function setParent(?Company $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}
