<?php

namespace Sirhplus\Api\Functions\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyFunctionResultSet;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Functions\Domain\FunctionNotFound;
use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Api\Functions\Domain\Model\AddFunctionModel;
use Sirhplus\Api\Functions\Domain\Model\EditFunctionModel;
use Sirhplus\Api\Functions\Domain\Repository\FindFunctionByCompanyRepositoryInterface;
use Sirhplus\Api\Functions\Domain\Repository\FunctionRepositoryInterface;
use Sirhplus\Api\Functions\Domain\ShowFunctionByIdResultSet;
use Symfony6\Entity\Company;
use Symfony6\Entity\Functions;

/**
 * class JobRepository
 */
final class FunctionRepository extends ServiceEntityRepository implements FunctionRepositoryInterface,
    FindFunctionByCompanyRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Functions::class);
    }

    /**
     * @param AddFunctionModel $model
     * @return void
     */
    public function add(AddFunctionModel $model): void
    {
        $function = (new Functions())
            ->setName($model->name);

        $this->_em->persist($function);
        $function->setCompany($this->getCompanyById($model->uuid));
        $this->_em->flush();
    }

    /**
     * @param EditFunctionModel $model
     * @return void
     * @throws FunctionNotFound
     */
    public function edit(EditFunctionModel $model): void
    {
        /** @var Functions $function */
        if (!($function = $this->find($model->uuid))) {
            throw new FunctionNotFound();
        }

        $function->setName($model->name);
        $this->_em->persist($function);
        $this->_em->flush();
    }

    /**
     * @param FunctionUuid $uuid
     * @return void
     * @throws FunctionNotFound
     */
    public function remove(FunctionUuid $uuid): void
    {
        /** @var Functions $function */
        if (!($function = $this->find($uuid))) {
            throw new FunctionNotFound();
        }

        $this->_em->remove($function);
        $this->_em->flush();
    }

    /**
     * @param CompanyUuid $uuid
     * @return Company
     */
    private function getCompanyById(CompanyUuid $uuid): Company
    {
        return $this->_em->find(Company::class, $uuid);
    }

    /**
     * @param CompanyUuid $uuid
     * @return CompanyFunctionResultSet
     */
    public function findFunctionByCompany(CompanyUuid $uuid): CompanyFunctionResultSet
    {
        $result = $this->createQueryBuilder('o')
                ->innerJoin('o.company', 'c')
                ->where('c.id = :uuid')
                ->setParameter('uuid', $uuid, 'uuid')
                ->getQuery()
                ->execute();

        return new CompanyFunctionResultSet($result, sizeof($result));
    }

    /**
     * @param FunctionUuid $uuid
     * @return ShowFunctionByIdResultSet
     */
    public function findById(FunctionUuid $uuid): ShowFunctionByIdResultSet
    {
        return ($object = $this->find($uuid))
            ? new ShowFunctionByIdResultSet($object)
            : throw new FunctionNotFound($uuid);
    }
}
