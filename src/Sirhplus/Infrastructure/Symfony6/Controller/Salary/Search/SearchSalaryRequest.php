<?php

namespace Symfony6\Controller\Salary\Search;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony6\Request\AbstractInputSearchRequest;

/**
 * class SearchSalaryRequest
 */
final class SearchSalaryRequest extends AbstractInputSearchRequest
{
    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->setKey('q');
        parent::__construct($requestStack);
    }
}
