<?php

namespace OC\PlatformBundle\Twig;

use OC\PlatformBundle\Antispam\OCAntispam;

class AntispamExtension extends \Twig_Extension
{
    /**
     * @var OCAntispam
     */
    protected $ocAntispam;

    public function __construct(OCAntispam $ocAntispam)
    {
        $this->ocAntispam = $ocAntispam;
    }

    public function checkIfArgumentIsSpam($text)
    {
        return $this->ocAntispam->isSpam($text);
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('checkIfSpam', [$this, 'checkIfArgumentIsSpam']),
        ];
    }

    public function getName()
    {
        return 'OCAntispam';
    }
}
