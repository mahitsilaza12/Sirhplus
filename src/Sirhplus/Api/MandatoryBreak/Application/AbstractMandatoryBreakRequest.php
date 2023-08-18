<?php

namespace Sirhplus\Api\MandatoryBreak\Application;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class AbstractMandatoryBreakRequest
 */
abstract class AbstractMandatoryBreakRequest extends ValueObject implements Request
{
    private mixed $input;
    private Collection $constraint;
    private static string $message = 'this fields is required';
    
    /**
     * @param string $name
     * @param string $workingTimes
     * @param string $pause
     * @param string $uuid
     */
    public function __construct(
        public string $name = '',
        public string $workingTimes = '',
        public string $pause = '',
        public string $uuid = ''

    ) {
        $this->name = $name;
        $this->workingTimes = $workingTimes;
        $this->pause = $pause;
        $this->input = [];
        $this->input['name'] = $name;
        $this->input['workingTimes'] = $workingTimes;
        $this->input['pause'] = $pause;
        $this->constraint = new Assert\Collection([
            'name' => new Assert\NotBlank([],self::$message),
            'workingTimes' => new Assert\NotBlank([],self::$message),
            'pause' => new Assert\NotBlank([],self::$message),
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