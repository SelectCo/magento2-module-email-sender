<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model\Email;

class Email implements EmailInterface
{
    private $templateIdentifier;
    private $templateOptions;
    private $templateVars;
    private $fromByScope;
    private $fromByScopeId;
    private $to;
    private $cc;
    private $bcc;
    private $attachments;

    /**
     * @inheritDoc
     */
    public function getTemplateIdentifier(): string
    {
        return $this->templateIdentifier;
    }

    /**
     * @inheritDoc
     */
    public function setTemplateIdentifier(string $templateIdentifier): void
    {
        $this->templateIdentifier = $templateIdentifier;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateOptions(): ?array
    {
        return $this->templateOptions;
    }

    /**
     * @inheritDoc
     */
    public function setTemplateOptions(array $templateOptions): void
    {
        $this->templateOptions = $templateOptions;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateVars(): ?array
    {
        return $this->templateVars;
    }

    /**
     * @inheritDoc
     */
    public function setTemplateVars(array $templateVars): void
    {
        $this->templateVars = $templateVars;
    }

    /**
     * @inheritDoc
     */
    public function getFromByScope()
    {
        return $this->fromByScope;
    }

    /**
     * @inheritDoc
     */
    public function setFromByScope($fromByScope): void
    {
        $this->fromByScope = $fromByScope;
    }

    /**
     * @inheritDoc
     */
    public function getFromByScopeId()
    {
        return $this->fromByScopeId;
    }

    /**
     * @inheritDoc
     */
    public function setFromByScopeId($fromByScopeId): void
    {
        $this->fromByScopeId = $fromByScopeId;
    }

    /**
     * @inheritDoc
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @inheritDoc
     */
    public function setTo($to): void
    {
        $this->to = $to;
    }

    /**
     * @inheritDoc
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @inheritDoc
     */
    public function setCc($cc): void
    {
        $this->cc = $cc;
    }

    /**
     * @inheritDoc
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @inheritDoc
     */
    public function setBcc($bcc): void
    {
        $this->bcc = $bcc;
    }

    /**
     * @inheritDoc
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     * @inheritDoc
     */
    public function setAttachments(array $attachments): void
    {
        $this->attachments = $attachments;
    }
}
