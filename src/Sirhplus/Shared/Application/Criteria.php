<?php

namespace Sirhplus\Shared\Application;

use Doctrine\Common\Collections\Criteria as CriteriaDoctrine;
use Doctrine\Common\Collections\Expr\Expression;

/**
 * class Criteria
 */
final class Criteria
{
    /** @var CriteriaDoctrine */
    private CriteriaDoctrine $criteria;

    /**
     * @param array $exp
     * @param array $sort
     * @param int $page
     * @param int $size
     * @param string $alias
     */
    public function __construct(
        public array $exp,
        public array $sort,
        public int $page,
        public int $size,
        public string $alias = 'o',
        public array $options = []
    ) {
        $page = ($page - 1) * $size;
        $this->criteria = new CriteriaDoctrine($this->buildExp($exp), $this->buildSort($sort), $page, $size);
    }

    /**
     * @return CriteriaDoctrine
     */
    public function getCriteria(): CriteriaDoctrine
    {
        return $this->criteria;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $exp
     * @return Expression|null
     */
    private function buildExp(array $exp): ?Expression
    {
        if ($exp === []) {
            return null;
        }

        // @todo filters here
        return CriteriaDoctrine::expr()->contains('', []);
    }

    /**
     * @param array $sort
     * @return array
     */
    private function buildSort(array $sort): array
    {
        $results = [];
        foreach ($sort as $field) {
            $order = ($field[0] === '-' ? CriteriaDoctrine::DESC : CriteriaDoctrine::ASC);
            $name = ($field[0] === '-' ? substr($field, 1, \strlen($field)) : $field);
            $results[$name] = $order;
        }

        return $results;
    }
}
