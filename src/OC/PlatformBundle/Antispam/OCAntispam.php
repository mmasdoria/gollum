<?php

namespace OC\PlatformBundle\Antispam;

class OCAntispam
{
    private $mailer;
    private $locale;
    private $minLength;

    /**
     * OCAntispam constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param int           $minLength
     */
    public function __construct(\Swift_Mailer $mailer,int $minLength =0)
    {
        $this->mailer    = $mailer;
        $this->minLength = (int)$minLength;
    }

    /**
     * @param $text
     *
     * @return bool
     */
    public function isSpam(string $text): bool
    {
        return strlen($text) < $this->minLength;
    }

    /**
     * @param $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
