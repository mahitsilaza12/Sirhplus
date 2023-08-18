<?php

namespace Sirhplus\Shared\Service;

use Symfony\Component\Validator\Constraints\Collection;

interface ValidateRequest
{
    /**
     * @return mixed
     */
    public function getInput(): mixed;

    /**
     * @return Collection|null
     */
    public function getConstraint(): ?Collection;
}
