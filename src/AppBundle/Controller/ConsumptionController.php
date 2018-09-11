<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Groups;
use AppBundle\Entity\Consumption;
use AppBundle\Entity\User;
use AppBundle\Form\GroupsType;
use AppBundle\Form\ConsumptionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ConsumptionController extends Controller
{
    /**
     * @Route("/consumption", name="consumption")
     */
    public function ViewConsumptionAction()
    {
        $us = unserialize($this->get('session')->get('_security_main'));
        $username = $us->getUsername();

        $repository = $this->getDoctrine()->getManager();
        $user = $repository->getRepository('AppBundle:User')->findOneBy(['username' => $username]);

        $consumption = $this->getDoctrine()
            ->getRepository('AppBundle:Consumption')
            ->findBy(['user' => $user->getId()]);


        return $this->render("consumption/consumption.html.twig", ['consumption' => $consumption]);
    }

    /**
     * @Route("/consumption/create", name="create_consumption")
     */
    public function CreateConsumptionAction(Request $request)
    {
        $consumption = new Consumption();

        $form = $this->createForm(ConsumptionType::class, $consumption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $us = unserialize($this->get('session')->get('_security_main'));
            $username = $us->getUsername();

            $repository = $this->getDoctrine()->getManager();
            $user = $repository->getRepository('AppBundle:User')->findOneBy(['username' => $username]);

            $consumption->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($consumption);
            $em->flush($consumption);

            $this->addFlash('success', 'You added a new consumption!');
            return $this->redirectToRoute('consumption');
        }

        return $this->render("consumption/createConsumption.html.twig", [
            'create_consumption_form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Consumption $consumption
     * @Route("/consumption/delete/{consumption}", name="delete_consumption")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function DeleteConsumption(Request $request, Consumption $consumption)
    {
        if ($consumption === null){
            return $this->redirectToRoute('consumption');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($consumption);
        $em->flush($consumption);

        return $this->redirectToRoute('consumption');
    }

    /**
     * @param Request $request
     * @param Consumption $consumption
     * @Route("/consumption/edit/{consumption}", name="edit_consumption")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function EditConsumption(Request $request, Consumption $consumption)
    {
        $form = $this->createForm(ConsumptionType::class, $consumption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $us = unserialize($this->get('session')->get('_security_main'));
            $username = $us->getUsername();

            $repository = $this->getDoctrine()->getManager();
            $user = $repository->getRepository('AppBundle:User')->findOneBy(['username' => $username]);

            $consumption->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->flush($consumption);

            $this->addFlash('success', 'You edit consumption!');
            return $this->redirectToRoute('consumption');
        }

        return $this->render("consumption/editConsumption.html.twig", [
            'edit_consumption_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/welcome", name="first_page_after_login")
     */
    public function calculateConsumption()
    {
        $us = unserialize($this->get('session')->get('_security_main'));
        $username = $us->getUsername();

        $repository = $this->getDoctrine()->getManager();
        $user = $repository->getRepository('AppBundle:User')->findOneBy(['username' => $username]);

        $consumption = $this->getDoctrine()->getRepository('AppBundle:Consumption')
            ->findBy(['user' => $user->getId()]);

        $alcohol = [];
        for ($i = 0; $i < count($consumption); $i++){
            $alcohol[$i] = $consumption[$i]->getAlcohol()->getPrice();
        }

        $sum = array_sum($alcohol);

        return $this->render('firstPageAfterLogin.html.twig', ['sum' => $sum]);
    }


}