<?php

namespace OC\PlatformBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class MessagePostEvent
 * @package OC\PlatformBundle\Event
 */
class MessagePostEvent extends Event
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * MessagePostEvent constructor.
     *
     * @param               $message
     * @param UserInterface $user
     */
    public function __construct($message, UserInterface $user)
    {
        $this->message = $message;
        $this->user    = $user;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    public function setMessage($message)
    {
        return $this->message = $message;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
