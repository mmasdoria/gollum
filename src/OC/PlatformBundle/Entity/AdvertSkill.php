<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OC\PlatformBundle\Model\AdvertInterface;
use OC\PlatformBundle\Model\AdvertSkillInterface;
use OC\PlatformBundle\Model\SkillInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="oc_advert_skill")
 */
class AdvertSkill implements AdvertSkillInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="level", type="string", length=255)
     */
    protected $level;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Advert")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $advert;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false)
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