<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use SelectCo\EmailSender\Model\Email\EmailInterface;
use SelectCo\EmailSender\Model\Mail\Template\TransportBuilder;

class Sender
{
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    public function __construct(TransportBuilder $transportBuilder)
    {
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * @param EmailInterface $email
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function send(EmailInterface $email): void
    {
        $this->transportBuilder->setTemplateIdentifier($email->getTemplateIdentifier())->addTo($email->getTo());

        if ($email->getTemplateOptions()) {
            $this->transportBuilder->setTemplateOptions($email->getTemplateOptions());
        }
        if ($email->getTemplateVars()) {
            $this->transportBuilder->setTemplateVars($email->getTemplateVars());
        }
        if ($email->getFromByScope()) {
            $this->transportBuilder->setFromByScope($email->getFromByScope());
        }
        if ($email->getBcc()) {
            $this->transportBuilder->addBcc($email->getBcc());
        }

        if ($email->getAttachments()) {
            foreach ($email->getAttachments() as $attachment) {
                $this->transportBuilder->addAttachment(
                    $attachment->getContents(),
                    $attachment->getFileName(),
                    $attachment->getFileType()
                );
            }
        }

        $this->transportBuilder->getTransport()->sendMessage();
    }
}
