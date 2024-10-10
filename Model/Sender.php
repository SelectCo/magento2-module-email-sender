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
use SelectCo\EmailSender\Model\Mail\Template\TransportBuilderFactory;

class Sender
{
    /**
     * @var TransportBuilderFactory
     */
    private $transportBuilderFactory;

    public function __construct(TransportBuilderFactory $transportBuilderFactory)
    {
        $this->transportBuilderFactory = $transportBuilderFactory;
    }

    /**
     * @param EmailInterface $email
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function send(EmailInterface $email): void
    {
        $transportBuilder = $this->transportBuilderFactory->create();
        $transportBuilder->setTemplateIdentifier($email->getTemplateIdentifier())->addTo($email->getTo());

        if ($email->getTemplateOptions()) {
            $transportBuilder->setTemplateOptions($email->getTemplateOptions());
        }
        if ($email->getTemplateVars()) {
            $transportBuilder->setTemplateVars($email->getTemplateVars());
        }
        if ($email->getFromByScope()) {
            $transportBuilder->setFromByScope($email->getFromByScope());
        }
        if ($email->getBcc()) {
            $transportBuilder->addBcc($email->getBcc());
        }

        if ($email->getAttachments()) {
            foreach ($email->getAttachments() as $attachment) {
                $transportBuilder->addAttachment(
                    $attachment->getContents(),
                    $attachment->getFileName(),
                    $attachment->getFileType()
                );
            }
        }

        $transportBuilder->getTransport()->sendMessage();
    }
}
