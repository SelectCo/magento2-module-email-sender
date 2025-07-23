<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace SelectCo\EmailSender\Model\Attachment;

interface AttachmentInterface
{
    /**
     * @return string
     */
    public function getContents(): string;

    /**
     * @param string $contents
     * @return void
     */
    public function setContents(string $contents): void;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @param string $fileName
     * @return void
     */
    public function setFileName(string $fileName): void;

    /**
     * @return string
     */
    public function getFileType(): string;

    /**
     * @param string $fileType
     * @return void
     */
    public function setFileType(string $fileType): void;
}
