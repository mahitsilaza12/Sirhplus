<?php

namespace Sirhplus\Shared\Service;

use Sirhplus\Shared\Domain\Model\EmailModel;

interface MailerInterface
{
    /**
     * @param EmailModel $model
     * @return void
     */
    public function send(EmailModel $model): void;
}
