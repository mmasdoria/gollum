<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface ImageInterface
 * @package OC\PlatformBundle\Model
 */
interface ImageInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getUrl(): ?string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @return string
     */
    public function getAlt(): ?string;

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void;

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile;


    /**
     * @param UploadedFile|null $file
     */
    public function setFile(UploadedFile $file);

    /**
     *
     */
    public function upload();

    /**
     * @return string
     */
    public function getUploadDir(): string;

    /**
     * @return String
     */
    public function getUploadRootDir(): string;

    /**
     *
     */
    public function preUpload(): void;

    /**
     *
     */
    public function preRemoveUpload(): void;

    /**
     *
     */
    public function removeUpload(): void;

    /**
     * @return string
     */
    public function getWebPath(): string;



}
