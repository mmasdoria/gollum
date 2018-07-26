<?php

declare(strict_types=1);

namespace OC\PlatformBundle\BigBrother;

use OC\PlatformBundle\Event\MessagePostEvent;

/**
 * Class MessageListener
 * @package OC\PlatformBundle\BigBrother
 */
class MessageListener
{
    /**
     * @var MessageNotificator
     */
    protected $notificator;

    /**
     * @var array
     */
    protected $listUsers = [];

    /**
     * MessageListener constructor.
     *
     * @param MessageNotificator $notificator
     * @param                    $listUsers
     */
    public function __construct(MessageNotificator $notificator, $listUsers)
    {
        $this->notificator = $notificator;
        $this->listUsers   = $listUsers;
    }

    /**
     * @param MessagePostEvent $event
     */
    public function processMessage(MessagePostEvent $event)
    {
        if (in_array($event->getUser()->getUsername(), $this->listUsers)) {
            $this->notificator->notifyByEmail($event->getMessage(), $event->getUser());
        }
    }
}
