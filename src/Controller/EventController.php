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
        $invitationToEvents = $user->getUserEventParticipations();
 
        foreach ($invitationToEvents as $invitation){
            $events[] = $invitation->getEvent();  
        }
        // dd($events);

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }
}
