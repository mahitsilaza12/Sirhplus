<?php

namespace Sirhplus\Api\AbsencePlan\Application\FindAbsencePlanById;

use Sirhplus\Shared\Service\Response;

final class ShowAbsencePlanByIdResponse implements Response
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
              'name' => $object->getName(),
              'companyUuid' => $this->object->getCompany()->getId(),
          ];
      }
}