<?php

declare(strict_types=1);

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('OCCoreBundle:home:index.html.twig');
    }

    /**
     * @return Response
     */
    public function contactAction(): Response
    {
        $this->addFlash('info', 'Page de contact pas encore dispo');

        return $this->redirectToRoute('oc_core_homepage');
    }
}
