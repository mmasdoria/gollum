<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Model\AdvertInterface;
use OC\PlatformBundle\Model\ApplicationInterface;
use OC\PlatformBundle\Model\ImageInterface;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertRepository")
 */
class Advert implements AdvertInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    protected $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist"})
     */
    protected $image;

    /**
     * @ORM\ManyToMany(targetEntity="CategoryInterface.php", cascade={"persist"})
     * @ORM\JoinTable(name="oc_advert_category")
     */

    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Application", mappedBy="advert")
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
    public function getCategories() :ArrayCollection
    {
        return $this->categories;
    }

    /**
     * @param \OC\PlatformBundle\Model\CategoryInterface $category
     */
    public function addCategory(\OC\PlatformBundle\Model\CategoryInterface $category): void
    {
        if (!$this->hasCategory($category)) {
            $this->categories->add($category);
        }
    }

    /**
     * @param \OC\PlatformBundle\Model\CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(\OC\PlatformBundle\Model\CategoryInterface $category): bool
    {
        return $this->categories->contains($category);
    }

    /**
     * @param \OC\PlatformBundle\Model\CategoryInterface $category
     */
    public function removeCategory(\OC\PlatformBundle\Model\CategoryInterface $category): void
    {
        if ($this->hasCategory($category)) {
            $this->categories->removeElement($category);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getApplications() :ArrayCollection
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
