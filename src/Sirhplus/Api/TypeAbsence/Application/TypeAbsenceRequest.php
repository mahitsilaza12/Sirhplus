<?php

namespace Sirhplus\Api\TypeAbsence\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class TypeAbsenceRequest
 */
abstract class TypeAbsenceRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    /**
     * @param string $type
     * @param string $color
     * @param boolean $visibility
     * @param string $typeRights
     * @param integer $rights
     * @param string $accumulationPeriod
     * @param string $rightsRenewalDate
     * @param string $accumulationFrequency
     * @param string $consumptionPeriod
     * @param string $methodOfReduction
     * @param boolean $absence
     * @param boolean $validation
     * @param string $postponement
     * @param boolean $limitPerWeek
     * @param boolean $activate
     * @param string $uuid
     * 
     */
    public function __construct(
        public string $type = '',
        public string $color = '',
        public bool $visibility = false,
        public string $typeRights = '',
        public float $rights = 0,
        public string $accumulationPeriod = '',
        public string $rightsRenewalDate = '',
        public string $accumulationFrequency = '',
        public string $consumptionPeriod = '',
        public string $methodOfReduction = '',
        public bool $absence = false,
        public bool $validation = false,
        public string $postponement = '',
        public bool $limitPerWeek = false,
        public bool $activate = false,
        string $uuid = null
    )
    {
        $this->type = $type;
        $this->input = [];
        $this->input['type'] = $type;
        $this->constraint = new Assert\Collection([
            'type' => new Assert\NotBlank([],self::$message)
        ]);
    }
    
    /**
     * @return mixed
     */
    public function getInput(): mixed
    {
        return $this->input;
    }

    /**
     * @return Collection
     */
    public function getConstraint(): Collection
    {
        return $this->constraint;
    }
}
