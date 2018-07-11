<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\AdvertType;
use OC\PlatformBundle\Model\AdvertInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        $nbPerPage = 3;

        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getAdverts($page, $nbPerPage);

        $nbPage = ceil(count($listAdverts) / $nbPerPage);
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(

            'listAdverts' => $listAdverts,
            'nbPages'     => $nbPage,
            'page'        => $page
        ));
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function viewAction(int $id): response
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {

            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");

        }

        $listApplications = $em
            ->getRepository('OCPlatformBundle:Application')
            ->findBy(array('advert' => $advert));

        $listAdvertSkills = $em
            ->getRepository('OCPlatformBundle:AdvertSkill')
            ->findBy(array('advert' => $advert));


        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(

            'advert' => $advert,

            'listApplications' => $listApplications,

            'listAdvertSkills' => $listAdvertSkills,

        ));
    }

    /**
     * @return Response
     */

    public function addAction(Request $request)

    {

        $advert = new Advert();

        $form = $this->createForm(AdvertType::class, $advert);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($advert);

            $em->flush();

            $this->addFlash('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));

        }


        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(

            'form' => $form->createView(),

        ));
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */

    public function editAction(int $id, Request $request): response
    {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {

            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");

        }

        $form = $this->createForm(AdvertEditType::class, $advert);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($advert);

            $em->flush();

            $this->addFlash('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));

        }


        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(

            'advert' => $advert,
            'form' => $form->createView(),

        ));

    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    public function deleteAction(int $id,Request $request): response
    {

        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();

            $this->addFlash('info', "L'annonce a bien été supprimée.");

            return $this->redirectToRoute('oc_platform_home');
        }

        return $this->render('OCPlatformBundle:Advert:delete.html.twig', array(
            'advert' => $advert,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @param $limit
     *
     * @return Response
     */
    public function menuAction($limit): response
    {
        $em = $this->getDoctrine()->getManager();

        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findBy(

            array(),

            array('date' => 'desc'),

            $limit,

            0

        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function purge($days)
    {

        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->deleteAdvertByDaysPassed($days);

        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts,
        ));
    }
}