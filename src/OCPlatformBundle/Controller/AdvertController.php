<?php

declare(strict_types=1);

namespace OCPlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class AdvertController
 * @package OCPlatformBundle\Controller
 */
class AdvertController extends Controller
{
    /**
     * @param $page
     *
     * @return Response
     */
    public function indexAction($page): response
    {

        if ($page < 1) {

            throw new NotFoundHttpException('Page "' . $page . '" inexistante.');

        }

        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => array()));
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function viewAction(int $id): response
    {
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request): response
    {

        if ($request->isMethod('POST')) {

            $this->addFlash('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));

        }

        return $this->render('OCPlatformBundle:Advert:add.html.twig');

    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */

    public function editAction(int $id, Request $request): response
    {

        $advert = [

            'title' => 'Recherche développpeur Symfony',

            'id' => $id,

            'author' => 'Alexandre',

            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',

            'date' => new \Datetime()

        ];


        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(

            'advert' => $advert

        ));

    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id): response
    {

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');

    }

    /**
     * @param $limit
     *
     * @return Response
     */
    public function menuAction($limit): response
    {
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
}
