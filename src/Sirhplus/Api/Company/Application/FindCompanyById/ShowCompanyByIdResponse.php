<?php

namespace Sirhplus\Api\Company\Application\FindCompanyById;

use Sirhplus\Shared\Service\Response;

/**
 * class ShowCompanyByIdResponse
 */
final class ShowCompanyByIdResponse implements Response
{
    /** @var array  */
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

    private function mapping(): void
    {
        $object = $this->object;
        $this->data = [
            'id' => $this->object->getId()->toRfc4122(),
            'information' => [
                'name' => $object->getName(),
                'logo' => $object->getLogo(),
                'createdAt' => $object->getCreatedAt()->format('Y-m-d'),
                'effective' => $object->getUsers()->count(),
                'legalStructure' => $object->getLegalStructure(),
                'sales' => $object->getSales(),
                'address' => $object->getAddress(),
                'phone' => $object->getPhoneNumber(),
                'website' => $object->getSite(),
            ],
            'identification' => [
                'siren' => $object->getIdentification()->getSiren(),
                'siret' => $object->getIdentification()->getSiret(),
                'tva' => $object->getIdentification()->getTva(),
                'activity'=>[
                    'sector' => $object->getIdentification()->getSector(),
                    'code' => $object->getIdentification()->getCode()
                ],
                'collectiveAgreement' => [
                    'details' => $object->getIdentification()->getDetails(),
                    'idcc' => $object->getIdentification()->getIdcc()
                ],
                'organism' => [
                    'provisioning' => $object->getIdentification()->getProvisioning(),
                    'healthComplementary' => $object->getIdentification()->getHealthComplementary(),
                    'pensionFund' => $object->getIdentification()->getPensionFund()
                ]
            ],
            'others' => [
                'leadingStatus' => $object->getLeadingStatus(),
                'schedule' => $object->getSchedule() ?? '',
                'assignment' => $object->getAssignment()
            ],
        ];
    }
}
