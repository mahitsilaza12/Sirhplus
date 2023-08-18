<?php

namespace Symfony6\Request;

use Sirhplus\Shared\Service\Request as RequestInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * class AbstractInputSearchRequest
 */
abstract class AbstractInputSearchRequest implements RequestInterface
{
    /**
     * @var float|int|bool|array|string|null
     */
    private float|int|bool|array|string|null $values;
    /**
     * @var string
     */
    private string $key;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(protected RequestStack $requestStack)
    {
        $request = $this->requestStack->getMainRequest();
        $this->values = $request->query->get($this->key);
    }

    /**
     * @return string|null
     */
    public function getValues(): ?string
    {
        return $this->values;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}
