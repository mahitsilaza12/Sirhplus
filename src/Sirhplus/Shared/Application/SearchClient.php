<?php

namespace Sirhplus\Shared\Application;

use Sirhplus\Shared\Domain\Query\QueryParams;

/**
 * class SearchClient
 */
final class SearchClient implements QueryParams
{
    /**
     * @param string $alias
     * @param array|null $fields
     * @param string $value
     */
    public function __construct(
        public readonly string $alias = 'o',
        private readonly array|null $fields = [],
        private readonly string $value = ''
    ) {
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        $parameters = [];

        foreach ($this->fields as $key) {
            $parameters[$key] = $this->value . '%';
        }

        return $parameters;
    }

    /**
     * @return string
     */
    public function getPredicates(): string
    {
        $predicate = '';
        $index = 0;
        $length = sizeof($this->fields) -1;

        foreach ($this->fields as $field) {
            $predicate .= sprintf('%s.%s LIKE :%s', $this->alias, $field, $field);

            if ($index !== $length) {
                $predicate .= ' or ';
            }
            $index++;
        }

        return $predicate;
    }
}
