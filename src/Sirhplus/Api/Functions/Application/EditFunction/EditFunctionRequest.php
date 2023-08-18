<?php

namespace Sirhplus\Api\Functions\Application\EditFunction;

use Sirhplus\Api\Functions\Application\FunctionRequest;

/**
 * class EditFunctionRequest
 */
final class EditFunctionRequest extends FunctionRequest
{
    /**
     * @param string $uuid
     * @param string $name
     */
    public function __construct(public string $uuid = '', public string $name = '')
    {
        parent::__construct($uuid, $name);
    }

    /**
     * @param string $uuid
     * @return EditFunctionRequest
     */
    public function setId(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
