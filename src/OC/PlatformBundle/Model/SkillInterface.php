<?php
/**
 * Created by PhpStorm.
 * User: tchavanne
 * Date: 06/07/18
 * Time: 09:16
 */

namespace OC\PlatformBundle\Model;
/**
 * Interface SkillInterface
 * @package OC\PlatformBundle\Model
 */
interface SkillInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;
}