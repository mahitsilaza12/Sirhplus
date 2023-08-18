<?php

namespace Sirhplus\Api\Functions\Domain\Repository;

use Sirhplus\Api\Functions\Domain\FunctionNotFound;
use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Functions\Domain\Model\AddFunctionModel;
use Sirhplus\Api\Functions\Domain\Model\EditFunctionModel;
use Sirhplus\Api\Functions\Domain\ShowFunctionByIdResultSet;

/**
 * interface JobRepositoryInterface
 */
interface FunctionRepositoryInterface
{
    /**
     * @param AddFunctionModel $model
     * @return void
     */
    public function add(AddFunctionModel $model): void;

    /**
     * @param EditFunctionModel $model
     * @return void
     * @throws FunctionNotFound
     */
    public function edit(EditFunctionModel $model): void;

    /**
     * @param FunctionUuid $uuid
     * @return void
     * @throws FunctionNotFound
     */
    public function remove(FunctionUuid $uuid): void;

    /**
     * @param FunctionUuid $uuid
     * @return ShowFunctionByIdResultSet
     */
    public function findById(FunctionUuid $uuid): ShowFunctionByIdResultSet;
}
