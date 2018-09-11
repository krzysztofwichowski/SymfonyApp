<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 2018-08-03
 * Time: 22:37
 */

namespace AppBundle\Controller;

use Exception;
use AppBundle\Form\AlcoholType;
use AppBundle\Entity\Alcohol;
use AppBundle\Entity\Groups;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AlcoholController extends Controller
{
    /**
     * @Route("/alcohol", name="alcohol")
     */
    public function ViewAlcoholAction()
    {
        $alcohol = $this->getDoctrine()
            ->getRepository('AppBundle:Alcohol')
            ->findAll();

        return $this->render("alcohol/alcohol.html.twig", ['alcohol' => $alcohol]);
    }

    /**
     * @Route("/alcohol/create", name="create_alcohol")
     */
    public function CreateAlcoholAction(Request $request)
    {
        $alcohol = new Alcohol();

        $form = $this->createForm(AlcoholType::class, $alcohol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($alcohol);
            $em->flush($alcohol);

            $this->addFlash('success', 'You added a new alcohol!');
            return $this->redirectToRoute('alcohol');
        }

        return $this->render("alcohol/createAlcohol.html.twig", ['create_alcohol_form' => $form->createView()]);
    }

    /**
     * @param Request $request
     * @param Alcohol $alcohol
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/alcohol/delete/{alcohol}", name="delete_alcohol")
     */
    public function DeleteAlcohol(Request $request, Alcohol $alcohol)
    {
        if ($alcohol === null){
            return $this->redirectToRoute('alcohol');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alcohol);
            $em->flush($alcohol);
        } catch (Exception $ex){
            $this->addFlash('warning', "You can't delete this alcohol, because is saved in someone consumption");
            return $this->redirectToRoute('alcohol');
        }

        return $this->redirectToRoute('alcohol');
    }

    /**
     * @param Request $request
     * @param Alcohol $alcohol
     * @Route("/alcohol/edit/{alcohol}", name="edit_alcohol")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function EditAlcohol(Request $request, Alcohol $alcohol)
    {
        $form = $this->createForm(AlcoholType::class, $alcohol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($alcohol);

            return $this->redirectToRoute('alcohol');
        }

        return $this->render("alcohol/editAlcohol.html.twig", ['edit_alcohol_form' => $form->createView()]);
    }
}