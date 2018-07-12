<?php

declare(strict_types=1);

namespace OC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OCUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
