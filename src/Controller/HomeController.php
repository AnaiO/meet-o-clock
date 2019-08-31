<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        $user = new Users();

        $form = $this->createForm(RegisterType::class, $user);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
}
