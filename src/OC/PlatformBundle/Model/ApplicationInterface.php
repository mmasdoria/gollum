<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

/**
 * Interface ApplicationInterface
 * @package OC\PlatformBundle\Model
 */
interface ApplicationInterface
{

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return ApplicationInterface
     */
    public function setAuthor(string $author): ApplicationInterface;

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor(): string;


    /**
     * Set content.
     *
     * @param string $content
     *
     * @return ApplicationInterface
     */
    public function setContent(string $content): ApplicationInterface;

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent(): string;


    /**
     * Set date.
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date);

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime;


    /**
     * @return AdvertInterface
     */
    public function getAdvert(): AdvertInterface;


    /**
     * @param AdvertInterface $advert
     */
    public function setAdvert(AdvertInterface $advert): void;

    /**

     */
    public function increase();

    /**

     */
    public function decrease();
}
