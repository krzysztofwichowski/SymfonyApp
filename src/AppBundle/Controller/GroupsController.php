<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Groups;
use AppBundle\Form\GroupsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Exception;


class GroupsController extends Controller
{
    /**
     * @Route("/groups", name="groups")
     */
    public function ViewGroupsAction()
    {
        $groups = $this->getDoctrine()
            ->getRepository('AppBundle:Groups')
            ->findAll();

        return $this->render("groups/groups.html.twig", ['groups' => $groups]);
    }

    /**
     * @Route("/groups/create", name="create_groups")
     */
    public function CreateGroupsAction(Request $request)
    {
        $groups = new Groups();

        $form = $this->createForm(GroupsType::class, $groups);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($groups);
            $em->flush($groups);

            $this->addFlash('success', 'You added a new group!');
            return $this->redirectToRoute('groups');
        }

        return $this->render("groups/createGroups.html.twig", [
            'create_groups_form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Groups $groups
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/groups/delete/{groups}", name="delete_groups")
     */
    public function DeleteGroups(Request $request, Groups $groups)
    {
        if ($groups === null){
            return $this->redirectToRoute('groups');
        }

        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($groups);
            $em->flush($groups);
        } catch (Exception $ex) {
            $this->addFlash('warning', "You can't do this because some alcohol belongs to this group!");
            return $this->redirectToRoute('groups');
        }

        return $this->redirectToRoute('groups');
    }

    /**
     * @param Request $request
     * @param Groups $groups
     * @Route("/groups/edit/{groups}", name="edit_groups")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function EditGroups(Request $request, Groups $groups)
    {
        $form = $this->createForm(GroupsType::class, $groups);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($groups);

            $this->addFlash('success', 'You edit existing group!');
            return $this->redirectToRoute('groups');
        }

        return $this->render("groups/editGroups.html.twig", ['edit_groups_form' => $form->createView()]);
    }

}