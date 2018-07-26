<?php

namespace OC\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package OC\UserBundle\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;
}