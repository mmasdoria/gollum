<?php

declare(strict_types=1);

namespace OCPlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AdvertController
 * @package OCPlatformBundle\Controller
 */
class AdvertController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {

        $url  = $this->get('router')->generate(
            'oc_platform_view',
            array('id' => 5),
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $trad = $this->get('translator')->trans('asdoria.ui.controller.advert.index'
        );

        return new Response($trad . $url);
    }


    /**
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {

        return $this->redirectToRoute('oc_platform_home');

    }


}