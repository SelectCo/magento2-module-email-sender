<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model\Mail\Template;

use Laminas\Mime\Message;
use Laminas\Mime\Mime;
use Laminas\Mime\PartFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\AddressConverter;
use Magento\Framework\Mail\EmailMessageInterfaceFactory;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\MessageInterfaceFactory;
use Magento\Framework\Mail\MimeMessageInterfaceFactory;
use Magento\Framework\Mail\MimePartInterfaceFactory;
use Magento\Framework\Mail\Template\FactoryInterface;
use Magento\Framework\Mail\Template\SenderResolverInterface;
use Magento\Framework\Mail\TransportInterfaceFactory;
use Magento\Framework\ObjectManagerInterface;

class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * @var array
     */
    protected $attachments = [];
    /**
     * @var Message
     */
    private $messageMime;
    /**
     * @var PartFactory
     */
    private $partFactory;

    /**
     * @param Message $messageMime
     * @param PartFactory $partFactory
     * @param FactoryInterface $templateFactory
     * @param MessageInterface $message
     * @param SenderResolverInterface $senderResolver
     * @param ObjectManagerInterface $objectManager
     * @param TransportInterfaceFactory $mailTransportFactory
     * @param MessageInterfaceFactory|null $messageFactory
     * @param EmailMessageInterfaceFactory|null $emailMessageInterfaceFactory
     * @param MimeMessageInterfaceFactory|null $mimeMessageInterfaceFactory
     * @param MimePartInterfaceFactory|null $mimePartInterfaceFactory
     * @param AddressConverter|null $addressConverter
     */
    public function __construct(
        Message                       $messageMime,
        PartFactory                   $partFactory,
        FactoryInterface              $templateFactory,
        MessageInterface              $message,
        SenderResolverInterface       $senderResolver,
        ObjectManagerInterface        $objectManager,
        TransportInterfaceFactory     $mailTransportFactory,
        ?MessageInterfaceFactory      $messageFactory = null,
        ?EmailMessageInterfaceFactory $emailMessageInterfaceFactory = null,
        ?MimeMessageInterfaceFactory  $mimeMessageInterfaceFactory = null,
        ?MimePartInterfaceFactory     $mimePartInterfaceFactory = null,
        ?AddressConverter $addressConverter = null
    ) {
        $this->templateFactory = $templateFactory;
        $this->messageMime = $messageMime;
        $this->partFactory = $partFactory;
        
        parent::__construct(
            $templateFactory,
            $message,
            $senderResolver,
            $objectManager,
            $mailTransportFactory,
            $messageFactory,
            $emailMessageInterfaceFactory,
            $mimeMessageInterfaceFactory,
            $mimePartInterfaceFactory,
            $addressConverter
        );
    }

    /**
     * @return self
     * @throws LocalizedException
     */
    protected function prepareMessage(): self
    {
        $message =  parent::prepareMessage();

        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                $body = $this->message->getBody();

                if (!$body) {
                    $body = $this->messageMime;
                }

                $body->addPart($attachment);
                $this->message->setBody($body);
            }

            $this->attachments = [];
        }

        return $message;
    }

    /**
     * @param $content
     * @param $fileName
     * @param $fileType
     * @param string|null $disposition
     * @param string|null $encoding
     * @return $this
     */
    public function addAttachment(
        $content,
        $fileName,
        $fileType,
        ?string $disposition = null,
        ?string $encoding = null
    ): self {
        $disposition = $disposition ?? Mime::DISPOSITION_ATTACHMENT;
        $encoding = $encoding ?? Mime::ENCODING_BASE64;

        $attachmentPart = $this->partFactory->create();
        $attachmentPart->setContent($content)
            ->setType($fileType)
            ->setFileName($fileName)
            ->setDisposition($disposition)
            ->setEncoding($encoding);

        $this->attachments[] = $attachmentPart;

        return $this;
    }
}
