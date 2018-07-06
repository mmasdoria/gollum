<?php
/**
 * Created by PhpStorm.
 * User: tchavanne
 * Date: 06/07/18
 * Time: 09:39
 */

namespace OC\PlatformBundle\Model;


/**
 * Interface AdvertSkillInterface
 * @package OC\PlatformBundle\Model
 */
interface AdvertSkillInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getLevel(): string;

    /**
     * @param string $level
     */
    public function setLevel(string $level): void;

    /**
     * @return AdvertInterface
     */
    public function getAdvert(): AdvertInterface;

    /**
     * @param AdvertInterface $advert
     */
    public function setAdvert(AdvertInterface $advert): void;

    /**
     * @return SkillInterface
     */
    public function getSkill(): SkillInterface;

    /**
     * @param SkillInterface $skill
     */
    public function setSkill(SkillInterface $skill): void;
}