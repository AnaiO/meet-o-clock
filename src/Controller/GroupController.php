<?php

namespace App\Controller;

use App\Entity\Users;
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
     * @Route("/group/edit/{user}", name="group_edit", methods={"GET", "POST"})
     * @Route("/group/new/{user}", name="group_new", methods={"GET", "POST"})
     */
    public function new(Users $user)
    {

    }
}