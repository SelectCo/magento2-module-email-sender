<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model\Email;

use SelectCo\EmailSender\Model\Attachment\AttachmentInterface;

interface EmailInterface
{
    /**
     * @return string
     */
    public function getTemplateIdentifier(): string;

    /**
     * @param string $templateIdentifier
     * @return void
     */
    public function setTemplateIdentifier(string $templateIdentifier): void;

    /**
     * @return array|null
     */
    public function getTemplateOptions(): ?array;

    /**
     * @param array $templateOptions
     * @return void
     */
    public function setTemplateOptions(array $templateOptions): void;

    /**
     * @return array|null
     */
    public function getTemplateVars(): ?array;

    /**
     * @param array $templateVars
     * @return void
     */
    public function setTemplateVars(array $templateVars): void;

    /**
     * @return array|string|null
     */
    public function getFromByScope();

    /**
     * @param array|string $fromByScope
     * @return void
     */
    public function setFromByScope($fromByScope): void;

    /**
     * @return int|string|null
     */
    public function getFromByScopeId();

    /**
     * @param int|string $fromByScopeId
     * @return void
     */
    public function setFromByScopeId($fromByScopeId): void;

    /**
     * @return array|string
     */
    public function getTo();

    /**
     * @param array|string $to
     * @return void
     */
    public function setTo($to): void;

    /**
     * @return array|string|null
     */
    public function getCc();

    /**
     * @param array|string $cc
     * @return void
     */
    public function setCc($cc): void;

    /**
     * @return array|string|null
     */
    public function getBcc();

    /**
     * @param array|string $bcc
     * @return void
     */
    public function setBcc($bcc): void;

    /**
     * @return AttachmentInterface[]|null
     */
    public function getAttachments(): ?array;

    /**
     * @param AttachmentInterface[] $attachments
     * @return void
     */
    public function setAttachments(array $attachments): void;
}
