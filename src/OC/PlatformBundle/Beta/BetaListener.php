<?php

namespace OC\PlatformBundle\Beta;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class BetaListener
 * @package OC\PlatformBundle\Beta
 */
class BetaListener
{
    /**
     * @var BetaHTMLAdder
     */
    protected $betaHTML;

    /**
     * @var \Datetime
     */
    protected $endDate;

    /**
     * BetaListener constructor.
     *
     * @param BetaHTMLAdder $betaHTML
     * @param               $endDate
     */
    public function __construct(BetaHTMLAdder $betaHTML, string $endDate)
    {
        $this->betaHTML = $betaHTML;
        $this->endDate  = new \Datetime($endDate);
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function processBeta(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $remainingDays = $this->endDate->diff(new \Datetime())->days;

        if ($remainingDays <= 0) {
            return;
        }

        $response = $this->betaHTML->addBeta($event->getResponse(), $remainingDays);

        $event->setResponse($response);
    }
}
