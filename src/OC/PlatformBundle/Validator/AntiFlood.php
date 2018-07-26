<?php

namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class AntiFlood
 * @package OC\PlatformBundle\Validator
 */
class AntiFlood extends Constraint
{
    /**
     * @var string
     */
    public $message = "Vous avez déjà posté un message il y a moins de 15 secondes, merci d'attendre un peu.";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'oc_platform_anti_flood';
    }
}