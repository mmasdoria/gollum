<?php

declare(strict_types=1);

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\UserBundle\Entity\User;

/**
 * Class LoadUser
 * @package OC\UserBundle\DataFixtures\ORM
 */
class LoadUser implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $listNames = ['Alexandre', 'Marine', 'Anna'];

        foreach ($listNames as $name) {
            $user = new User;

            $user->setUsername($name);
            $user->setPassword($name);
            $user->setalt('');
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
