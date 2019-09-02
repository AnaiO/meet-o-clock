<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    /**
     * @Route("/events/{user}", name="events", methods={"GET"})
     */
    public function listByUser(Users $user)
    {
        $groupsOfUser = $user->getGroups();

        foreach ($groupsOfUser as $group){
            $events = $group->getEvents();
            foreach ($events as $event){
                $eventsOfUser[] = $event;
            }
        }
        // dd($eventsOfUser);
        return $this->render('event/index.html.twig', [
            'eventsOfUser' => $eventsOfUser,
        ]);
    }
}
