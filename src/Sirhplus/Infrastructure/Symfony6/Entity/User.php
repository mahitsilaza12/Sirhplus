<?php

namespace Symfony6\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sirhplus\Api\User\Infrastructure\Doctrine\UserRepository;
use Sirhplus\Shared\Domain\Exception\InvalidSexeValueException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Annotations as OA;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use IdentityUuid;

    /**
     * @var string $email
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    /**
     * @var string|null $email
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $lastName;

    /**
     * @var string|null $email
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $firstName;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    #[Assert\Length(
        max: 1,
        maxMessage: 'Max characters 1',
    )]
    #[Assert\NotBlank]
    private string $sex;

    /**
     * @var \DateTime
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime $dateOfBirth;

    /**
     * @var string|null $responsibility
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private string|null $responsibility;

    /**
     * @var string|null $phoneNumber
     */
    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private string|null $phoneNumber;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(type: 'string', nullable: false)]
    private string $password;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    private Company $company;

    #[ORM\ManyToOne(targetEntity: Salary::class, cascade: ["persist"], inversedBy: 'user')]
    private Salary $salary;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: 'teams')]
    private Collection|null $teams;

    /**
     * @OA\Property(type="array", @OA\Items(type="string"))
     * @var array
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->firstName.' '.$this->lastName;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return User
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     *
     * @return $this
     */
    public function setSex(string $sex): self
    {
        if ($sex === 'M' || $sex ==='F') {
            $this->sex = $sex;

            return $this;
        }

        throw new InvalidSexeValueException();
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }
    /**
     * @param \DateTime $dateOfBirth
     *
     * @return $this
     */
    public function setDateOfBirth(\DateTime $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResponsibility(): ?string
    {
        return $this->responsibility;
    }

    /**
     * @param string $responsibility
     */
    public function setResponsibility(string $responsibility): self
    {
        $this->responsibility = $responsibility;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * @return Salary
     */
    public function getSalary(): Salary
    {
        return $this->salary;
    }

    /**
     * @param Salary $salary
     * @return User
     */
    public function setSalary(Salary $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getTeams(): ?Collection
    {
        return $this->teams;
    }

    /**
     * @param Team|null $team
     *
     * @return $this
     */
    public function addTeam(?Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams = $team;
        }

        return $this;
    }
}
