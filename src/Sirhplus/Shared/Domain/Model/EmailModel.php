<?php

namespace Sirhplus\Shared\Domain\Model;

/**
 * class EmailModel
 */
final class EmailModel
{
    public string $to;
    public string $subject;
    public string $template;
    public array $context = [];

    /**
     * @param string $to
     * @param string $subject
     * @param string $template
     * @param array $context
     */
    public function __construct(
        string $to = '',
        string $subject = '',
        string $template = '',
        array $context = []
    ) {
        $this->to = $to;
        $this->subject = $subject;
        $this->template = $template;
        $this->context = $context;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function to(string $to): EmailModel
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param null|string $subject
     * @return $this
     */
    public function subject(?string $subject): EmailModel
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param null|string $template
     * @return $this
     */
    public function template(?string $template): EmailModel
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @param array|null $context
     * @return $this
     */
    public function context(?array $context): EmailModel
    {
        $this->context = $context;

        return $this;
    }
}
