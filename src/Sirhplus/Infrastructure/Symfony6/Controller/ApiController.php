<?php

namespace Symfony6\Controller;

use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Symfony\Component\Validator\Validation;

/**
 * class ApiController
 */
abstract class ApiController
{
    /**
     * @param Request $request
     * @return void
     */
    protected function validateRequest(Request $request): void
    {
        if ($request->getConstraint()) {
            $violations = Validation::createValidator()->validate($request->getInput(), $request->getConstraint());

            if ($violations->count()) {
                foreach ($violations as $violation) {
                    throw new InvalidValueException($violation->getMessage());
                }
            }
        }
    }
}
