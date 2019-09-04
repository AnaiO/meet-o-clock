<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Groups;
use App\Form\GroupsType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupController extends AbstractController
{
    /**
     * @Route("/groups/{user}", name="user_groups", methods={"GET"})
     */
    public function list(Users $user)
    {
        $groups = $user->getGroups();
        
        return $this->render('group/list.html.twig', [
            'groups' => $groups
        ]);
    }

    /**
     * @Route("/group/edit/{user}/{group}", name="group_edit", methods={"GET", "POST"})
     * @Route("/group/new/{user}", name="group_new", methods={"GET", "POST"})
     */
    public function new(Users $user, Request $request, ObjectManager $om, Groups $group = null)
    {
        if (!$group){
            $group = new Groups();
        }
        
        $form = $this->createForm(GroupsType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om->persist($group);
            $om->flush();
        }

        return $this->render('group/form.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    /**
     * @Route("/delete/{group}", name="group_delete", methods={"DELETE"})
     */
    public function delete(Groups $group, ObjectManager $om)
    {
        $om->remove($group);
        $om->flush();
    }
}