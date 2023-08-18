<?php

namespace Sirhplus\Shared\Application;

/**
 * class Select
 */
final class Select
{
    /**
     * Select constructor.
     * @param array $fields
     * @param string $alias
     * @param bool $fetchArray
     */
    public function __construct(
        public array $fields = [],
        public string $alias = 'o',
        public bool $fetchArray = false
    ) {
    }

    /**
     * @return string|null
     */
    public function getFields(): ?string
    {
        $alias = $this->alias;

        if (!$this->fetchArray) {
            return $alias;
        }

        return implode(
            ',',
            array_map(static function ($field) use ($alias) {
                return "$alias.$field";
            }, $this->fields)
        );
    }

    /**
     * @return bool|null
     */
    public function getFetchArray(): ?bool
    {
        return $this->fetchArray;
    }
}
