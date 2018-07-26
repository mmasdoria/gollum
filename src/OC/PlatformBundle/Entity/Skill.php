<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use OC\PlatformBundle\Model\SkillInterface;

/**
 * Class Skill
 * @package OC\PlatformBundle\Entity
 */
class Skill implements SkillInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
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
    public function getName(): string
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
