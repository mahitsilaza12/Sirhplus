<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model;

use Sirhplus\Shared\Service\Request;

/**
 * class EditTeamModel
 */
final class EditTeamModel extends TeamModel
{
    /**
     * @param string $uuid
     * @param string $name
     */
    public function __construct(public string $uuid, public string $name)
    {
        parent::__construct(null, $name, $uuid);
    }

    /**
     * @param Request $request
     * @return EditTeamModel
     */
    public static function create(Request $request): EditTeamModel
    {
        return new self($request->uuid, $request->name);
    }
}
