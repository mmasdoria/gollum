<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use OC\PlatformBundle\Model\ImageInterface;

/**
 * Class Image
 * @package OC\PlatformBundle\Entity
 */
class Image implements ImageInterface
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $alt;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

}
