<?php
// src/OC/PlatformBundle/Beta/BetaHTMLAdder.php

namespace OC\PlatformBundle\Beta;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class BetaHTMLAdder
 * @package OC\PlatformBundle\Beta
 */
class BetaHTMLAdder
{
    /**
     * @param Response $response
     * @param          $remainingDays
     *
     * @return Response
     */
    public function addBeta(Response $response, $remainingDays)
    {
        $content = $response->getContent();

        // Code à rajouter
        $html
            = '<div style="position: absolute; top: 0;background: orange; width: 100%; text-align: center; padding: 0.5em;">Beta J-' . (int)$remainingDays . ' !</div>';

        $content = str_replace(
            '<body>',
            '<body> ' . $html,
            $content
        );

        $response->setContent($content);

        return $response;
    }
}