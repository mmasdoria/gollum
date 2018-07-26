<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use OC\PlatformBundle\Model\AdvertInterface;
use OC\PlatformBundle\Model\AdvertSkillInterface;
use OC\PlatformBundle\Model\SkillInterface;

/**
 * Class AdvertSkill
 * @package OC\PlatformBundle\Entity
 */
class AdvertSkill implements AdvertSkillInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $level;

    /**
     * @var AdvertInterface
     */
    protected $advert;

    /**
     * @var SkillInterface
     */
    protected $skill;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLevel():string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return AdvertInterface
     */
    public function getAdvert():AdvertInterface
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

    /**
     * @return SkillInterface
     */
    public function getSkill():SkillInterface
    {
        return $this->skill;
    }

    /**
     * @param SkillInterface $skill
     */
    public function setSkill(SkillInterface $skill): void
    {
        $this->skill = $skill;
    }
}
