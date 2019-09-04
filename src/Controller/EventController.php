<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Users;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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

        return $this->render('event/list.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/event/edit/{user}/{event}", name="event_edit", methods={"GET","POST"})
     * @Route("/event/new/{user}", name="event_new", methods={"GET","POST"})
     */
    public function form(Users $user, Event $event = null, Request $request, ObjectManager $om)
    {
        if (!$event){
            $event = new Event();
        }

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $om->persist($event);
            $om->flush();
        }

        return $this->render('event/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
