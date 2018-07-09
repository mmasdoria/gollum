<?php
declare(strict_types=1);

namespace OC\PlatformBundle\Email;

use OC\PlatformBundle\Entity\Application;

/**
 * Class ApplicationMailer
 * @package OC\PlatformBundle\Email
 */
class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * ApplicationMailer constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Application $application
     */
    public function sendNewNotification(Application $application)
    {
        $message = new \Swift_Message(
            'Nouvelle candidature',
            'Vous avez reçu une nouvelle candidature.'
        );

        $message
            ->addTo($application->getAdvert()->getAuthor()) // Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
            ->addFrom('ocbundle@yopmail.com')
        ;

        $this->mailer->send($message);
    }
}
