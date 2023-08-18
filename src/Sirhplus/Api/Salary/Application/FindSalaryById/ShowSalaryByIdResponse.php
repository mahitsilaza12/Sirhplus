<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryById;

use Sirhplus\Shared\Service\Response;

final class ShowSalaryByIdResponse implements Response
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->data = [];
        $this->mapping();
    }

    /**
     * @param object $object
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }
    /**
     * @return void
     */
    private function mapping(): void
    {
        $this->data = [
            'infos' => [],
            'salary' => [
                'hiringDate' => $this->object->getHiringDate(),
                'status' => $this->object->isStatus(),
            ],
            'site' => [
                'siteId' => !$this->object->getSite() ? '' : $this->object->getSite()->getId(),
                'name' => !$this->object->getSite() ? '' : $this->object->getSite()->getName(),
            ],
            'absencePlan' => [
                'absencePlanId' => !$this->object->getAbsencePlan() ? '' : $this->object->getAbsencePlan()->getId(),
                'name' => !$this->object->getAbsencePlan() ? '' : $this->object->getAbsencePlan()->getName(),
            ],
            'crew' => [
                'crewId' => !$this->object->getCrew() ? '' : $this->object->getCrew()->getId(),
                'name' => !$this->object->getCrew() ? '' : $this->object->getCrew()->getName(),
            ],
            'functions' => [
                'functionId' => !$this->object->getFunctions() ? '' : $this->object->getFunctions()->getId(),
                'name' => !$this->object->getFunctions() ? '' : $this->object->getFunctions()->getName(),
            ],
            'hourlyRegime' => [
                'hourlyRegimeId' => !$this->object->getHourlyRegime() ? '' : $this->object->getHourlyRegime()->getId(),
                'name' => !$this->object->getHourlyRegime() ? '' : $this->object->getHourlyRegime()->getName(),
            ],
        ];
    }
}
