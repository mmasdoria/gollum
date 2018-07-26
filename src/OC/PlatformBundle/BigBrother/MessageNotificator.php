<?php

declare(strict_types=1);

namespace OC\PlatformBundle\BigBrother;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class MessageNotificator
 * @package OC\PlatformBundle\BigBrother
 */
class MessageNotificator
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * MessageNotificator constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param string        $message
     * @param UserInterface $user
     */
    public function notifyByEmail(string $message, UserInterface $user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject("Nouveau message d'un utilisateur surveillé")
            ->setFrom('admin@votresite.com')
            ->setTo('admin@votresite.com')
            ->setBody("L'utilisateur surveillé '".$user->getUsername()."' a posté le message suivant : '".$message."'")
        ;

        $this->mailer->send($message);
    }
}
