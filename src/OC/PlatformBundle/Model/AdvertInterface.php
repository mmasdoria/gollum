<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

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
    public function getId(): ?int;

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
    public function getTitle(): ?string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getAuthor(): ?string;

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void;

    /**
     * @return string
     */
    public function getContent(): ?string;

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
     * @return Collection
     */
    public function getCategories(): Collection;

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
     * @return Collection
     */
    public function getApplications(): Collection;

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

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime;

    /**
     * @param \DateTime $updatedAt
     *
     * @return \DateTime
     */
    public function setUpdatedAt(\DateTime $updatedAt): void;

    /**
     *
     */
    public function updateDate(): void;

    /**
     * @return int
     */
    public function getNbApplications(): int;

    /**
     * @param int $nb
     */
    public function setNbApplications(int $nb): void;

    /**
     *
     */
    public function increaseNbApplication(): void;

    /**
     *
     */
    public function decreaseNbApplication(): void;

     /**
     * @return int
     */
    public function getSlug(): string;

    /**
     * @param int $nb
     */
    public function setSlug(string $slug): void;
}
