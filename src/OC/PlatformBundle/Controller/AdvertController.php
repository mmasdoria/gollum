<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\AdvertSkill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Advert;

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
        $em = $this->getDoctrine()->getManager();

        $advert = $em
            ->getRepository('OCPlatformBundle:Advert')
            ->find($id);
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

            'listAdvertSkills' => $listAdvertSkills

        ));
    }

    /**
     * @return Response
     */
    public function addAction(): response
    {
        $em = $this->getDoctrine()->getManager();

        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony.');
        $advert->setAuthor('Alexandre');
        $advert->setContent("Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…");

        $listSkills = $em->getRepository('OCPlatformBundle:Skill')->findAll();

        foreach ($listSkills as $skill) {
            $advertSkill = new AdvertSkill();

            $advertSkill->setAdvert($advert);
            $advertSkill->setSkill($skill);

            $advertSkill->setLevel('Expert');

            $em->persist($advertSkill);
        }

        $em->persist($advert);

        $em->flush();

        return $this->render('OCPlatformBundle:Advert:add.html.twig', array('advert' => $advert));

    }

    /**
     * @param int $id
     *
     * @return Response
     */


    public function editAction(int $id): response
    {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
        if (null === $advert) {

            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");

        }

        $listCategories = $em->getRepository('CategoryInterface.php')->findAll();

        foreach ($listCategories as $category) {

            $advert->addCategory($category);

        }

        $em->flush();


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

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {

            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");

        }

        foreach ($advert->getCategories() as $category) {

            $advert->removeCategory($category);

        }
        $em->flush();
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');

    }

    /**
     * @return Response
     */
    public function menuAction(): response
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
