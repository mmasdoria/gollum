<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

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
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @return string
     */
    public function getAlt(): string;

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void;

}
