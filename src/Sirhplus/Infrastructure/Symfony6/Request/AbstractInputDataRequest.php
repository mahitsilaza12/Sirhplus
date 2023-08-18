<?php

namespace Symfony6\Request;

use Sirhplus\Shared\Service\Request as RequestInterface;
use Sirhplus\Shared\Service\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class AbstractInputDataRequest
 */
abstract class AbstractInputDataRequest implements RequestInterface
{
    protected int $page;
    protected int $size;
    protected array $sort;
    protected array $fields;
    protected array $filters;

    /**
     * InputDataRequest constructor.
     * @param RequestStack $request
     */
    public function __construct(protected RequestStack $request)
    {
        $this->extractAndValidateData($request->getMainRequest());
        $this->sort = [];
        $this->fields = [];
        $this->filters = [];
    }

    /**
     * @return Request|null
     */
    public function getRequest(): ?Request
    {
        return $this->request->getMainRequest();
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return mixed[]
     */
    public function getSort(): array
    {
        return $this->sort;
    }

    /**
     * @return mixed[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return mixed[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function extractAndValidateData(Request $request): void
    {
        $query = $request->query->all();

        $page = $query['page'] ?? 0;
        $size = $query['limit'] ?? 0;
        $number = 0 === $page ? Response::DEFAULT_PAGE : $page;
        $size = 0 === $size ? Response::DEFAULT_SIZE : $size;

        $this->page = $number;
        $this->size = $size;
    }
}
