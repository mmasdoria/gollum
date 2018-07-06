<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * Class AdvertInterface
 * @package OC\PlatformBundle\Model
 */
interface AdvertInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * @return mixed
     */
    public function getPublished(): bool;

    /**
     * @param mixed $published
     */
    public function setPublished(string $published): void;

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime;

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getAuthor(): string;

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * @return mixed
     */
    public function getImage(): ?ImageInterface;

    /**
     * @param mixed $image
     */
    public function setImage(?ImageInterface $image = null): void;

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection;

    /**
     * @param CategoryInterface $category
     */
    public function addCategory(CategoryInterface $category): void;

    /**
     * @param CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(CategoryInterface $category): bool;

    /**
     * @param CategoryInterface $category
     */
    public function removeCategory(CategoryInterface $category): void;

    /**
     * @return ArrayCollection
     */
    public function getApplications(): ArrayCollection;

    /**
     * @param ApplicationInterface $application
     */
    public function addApplication(ApplicationInterface $application): void;

    /**
     * @param ApplicationInterface $application
     *
     * @return bool
     */
    public function hasApplication(ApplicationInterface $application): bool;

    /**
     * @param ApplicationInterface $application
     */
    public function removeApplication(ApplicationInterface $application): void;

}
