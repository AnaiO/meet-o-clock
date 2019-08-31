<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        $user = new Users();

        $form = $this->createForm(RegisterType::class, $user);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
