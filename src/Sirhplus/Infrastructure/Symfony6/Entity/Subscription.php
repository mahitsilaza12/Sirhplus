<?php

namespace Symfony6\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Subscription
{
    use IdentityUuid;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 15)]
    private string $type;

    /**
     * @var float
     */
    #[ORM\Column(type: 'decimal', precision: 8, scale: 2)]
    private float $rate;

    #[ORM\Column(type: 'boolean')]
    private bool $isFree;

    /**
     * @var \DateTime
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime|null $expiredIn;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Subscription
     */
    public function setType(string $type): Subscription
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     *
     * @return Subscription
     */
    public function setRate(float $rate): Subscription
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredIn(): ?\DateTime
    {
        return $this->expiredIn;
    }

    /**
     * @param \DateTime $expiredIn
     *
     * @return Subscription
     */
    public function setExpiredIn(\DateTime  $expiredIn): Subscription
    {
        $this->expiredIn = $expiredIn;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFree(): bool
    {
        return $this->isFree;
    }

    /**
     * @param bool $isFree
     *
     * @return $this
     */
    public function setIsFree(bool $isFree): self
    {
        $this->isFree = $isFree;

        return $this;
    }
}
