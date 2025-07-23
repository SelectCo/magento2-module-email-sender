<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model\Attachment;

class Attachment implements AttachmentInterface
{
    private $contents;
    private $fileName;
    private $fileType;

    /**
     * @inheritDoc
     */
    public function getContents(): string
    {
        return $this->contents;
    }

    /**
     * @inheritDoc
     */
    public function setContents(string $contents): void
    {
        $this->contents = $contents;
    }

    /**
     * @inheritDoc
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @inheritDoc
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @inheritDoc
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * @inheritDoc
     */
    public function setFileType(string $fileType): void
    {
        $this->fileType = $fileType;
    }
}
