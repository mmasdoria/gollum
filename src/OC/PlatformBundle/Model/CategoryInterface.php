<?php
/**
 * Created by PhpStorm.
 * User: tchavanne
 * Date: 05/07/18
 * Time: 15:17
 */

declare(strict_types=1);

namespace OC\PlatformBundle\Model;

/**
 * Interface Category
 * @package OC\PlatformBundle\Model
 */
interface CategoryInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;
}