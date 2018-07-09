<?php

declare(strict_types=1);

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\CategoryInterface;

/**
 * Class LoadCategory
 * @package OC\PlatformBundle\DataFixtures\ORM
 */
class LoadCategory extends Fixture implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Développement web',
            'Développement mobile',
            'Graphisme',
            'Intégration',
            'Réseau'
        );

        foreach ($names as $name) {
            $category = new CategoryInterface();
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();
    }
}