<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

/**
 * Class Category
 * @package OC\PlatformBundle\Entity
 */
class Category implements \OC\PlatformBundle\Model\CategoryInterface
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
