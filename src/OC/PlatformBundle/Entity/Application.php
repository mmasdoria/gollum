<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use OC\PlatformBundle\Model\AdvertInterface;
use OC\PlatformBundle\Model\ApplicationInterface;

/**
 * Class Application
 * @package OC\PlatformBundle\Entity
 */
class Application implements ApplicationInterface
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $author;

    /**
     * @var
     */
    protected $content;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var
     */
    private $advert;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->date       = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return ApplicationInterface
     */
    public function setAuthor(string $author): ApplicationInterface
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return ApplicationInterface
     */
    public function setContent(string $content): ApplicationInterface
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return Advert
     */
    public function getAdvert(): AdvertInterface
    {
        return $this->advert;
    }

    /**
     * @param AdvertInterface $advert
     */
    public function setAdvert(AdvertInterface $advert): void
    {
        $this->advert = $advert;
    }
}
