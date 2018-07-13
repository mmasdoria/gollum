<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Event\MessagePostEvent;
use OC\PlatformBundle\Event\PlatformEvents;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

        return $this->render('OCPlatformBundle:Advert:index.html.twig', [
            'listAdverts' => $listAdverts,
            'nbPages'     => $nbPage,
            'page'        => $page
        ]);
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
            ->findBy(['advert' => $advert]);

        $listAdvertSkills = $em
            ->getRepository('OCPlatformBundle:AdvertSkill')
            ->findBy(['advert' => $advert]);


        return $this->render('OCPlatformBundle:Advert:view.html.twig', [
            'advert'           => $advert,
            'listApplications' => $listApplications,
            'listAdvertSkills' => $listAdvertSkills,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */

    public function addAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
            throw new AccessDeniedException('Accès limité aux auteurs.');
        }
        $advert = new Advert();
        $form   = $this->createForm(AdvertType::class, $advert);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $event = new MessagePostEvent($advert->getContent(), $this->getUser());

            $this->get('event_dispatcher')->dispatch(PlatformEvents::POST_MESSAGE, $event);

            $advert->setContent($event->getMessage());

            $em = $this->getDoctrine()->getManager();

            $em->persist($advert);
            $em->flush();

            $this->addFlash('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('oc_platform_view', ['id' => $advert->getId()]);
        }

        return $this->render('OCPlatformBundle:Advert:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */

    public function editAction(int $id, Request $request): response
    {
        $em     = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        $form = $this->createForm(AdvertEditType::class, $advert);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($advert);
            $em->flush();

            $this->addFlash('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', ['id' => $advert->getId()]);
        }


        return $this->render('OCPlatformBundle:Advert:add.html.twig', [

            'advert' => $advert,
            'form'   => $form->createView(),

        ]);
    }

    /**
     * @param int     $id
     * @param Request $request
     *
     * @return Response
     */
    public function deleteAction(int $id, Request $request): response
    {

        $em     = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();

            $this->addFlash('info', "L'annonce a bien été supprimée.");

            return $this->redirectToRoute('oc_platform_home');
        }

        return $this->render('OCPlatformBundle:Advert:delete.html.twig', [
            'advert' => $advert,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * @param $limit
     *
     * @return Response
     */
    public function menuAction($limit): response
    {
        $em          = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findBy(
            [],
            ['date' => 'desc'],
            $limit,
            0
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', [
            'listAdverts' => $listAdverts
        ]);
    }

    /**
     * @param $days
     *
     * @return Response
     */
    public function purge($days)
    {
        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->deleteAdvertByDaysPassed($days);

        return $this->render('OCPlatformBundle:Advert:index.html.twig', [
            'listAdverts' => $listAdverts,
        ]);
    }

    /**
     * @return Response
     */
    public function testAction()
    {
        $advert = new Advert;

        $advert->setDate(new \Datetime());  // Champ « date » OK
        $advert->setTitle('titret');           // Champ « title » incorrect : moins de 10 caractères
        $advert->setContent('blabla');    // Champ « content » incorrect : on ne le définit pas
        $advert->setAuthor('Abb');            // Champ « author » incorrect : moins de 2 caractères

        // On récupère le service validator
        $validator  = $this->get('validator');
        $listErrors = $validator->validate($advert);
        $content    = count($listErrors) > 0 ? (string)$listErrors : "L'annonce est valide !";

        return new Response($content);
    }

    /**
     * @param $name
     *
     * @return Response
     */
    public function translationAction(string $name)
    {
        return $this->render('OCPlatformBundle:Advert:translation.html.twig', [
            'name' => $name
        ]);
    }
}
