<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Model\AdvertInterface;
use OC\PlatformBundle\Model\ApplicationInterface;
use OC\PlatformBundle\Model\CategoryInterface;
use OC\PlatformBundle\Model\ImageInterface;

/**
 * Class Advert
 * @package OC\PlatformBundle\Entity
 */
class Advert implements AdvertInterface
{
    /**
     * @var int
     *
     */
    protected $id;

    /**
     * @var bool
     */
    protected $published = true;

    /**
     * @var \DateTime
     */
    protected $date;


    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     *
     */
    protected $author;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var ImageInterface
     */
    protected $image;

    /**
     * @var ArrayCollection
     */
    protected $categories;

    /**
     * @var ArrayCollection
     */
    protected $applications;

    /**
     * Advert constructor.
     */
    public function __construct()
    {
        $this->date         = new \DateTime();
        $this->categories   = new ArrayCollection();
        $this->applications = new ArrayCollection();
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
     * @return mixed
     */
    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished(string $published): void
    {
        $this->published = $published;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getImage(): ?ImageInterface
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(?ImageInterface $image = null): void
    {
        $this->image = $image;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param CategoryInterface $category
     */
    public function addCategory(CategoryInterface $category): void
    {
        if (!$this->hasCategory($category)) {
            $this->categories->add($category);
        }
    }

    /**
     * @param CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(CategoryInterface $category): bool
    {
        return $this->categories->contains($category);
    }

    /**
     * @param CategoryInterface $category
     */
    public function removeCategory(CategoryInterface $category): void
    {
        if ($this->hasCategory($category)) {
            $this->categories->removeElement($category);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getApplications(): ArrayCollection
    {
        return $this->applications;
    }

    /**
     * @param ApplicationInterface $application
     */
    public function addApplication(ApplicationInterface $application): void
    {
        if (!$this->hasApplication($application)) {
            $this->applications->add($application);
            $application->setAdvert($this);
        }
    }

    /**
     * @param ApplicationInterface $application
     *
     * @return bool
     */
    public function hasApplication(ApplicationInterface $application): bool
    {
        return $this->applications->contains($application);
    }

    /**
     * @param ApplicationInterface $application
     */
    public function removeApplication(ApplicationInterface $application): void
    {
        if ($this->hasApplication($application)) {
            $this->applications->removeElement($application);
        }
    }
}
