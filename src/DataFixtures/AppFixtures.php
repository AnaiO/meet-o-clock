<?php
namespace App\DataFixtures;
use Faker;
use Faker\Factory;
use App\Entity\Alert;
use App\Entity\Event;
use App\Entity\UserEventParticipation;
use App\Entity\Adress;
use App\Entity\Users;
use App\Entity\Comment;
use App\Entity\Groups;
use App\Entity\Category;
use App\Entity\Subscription;
use Faker\ORM\Doctrine\Populator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = Factory::create('fr_FR');
        $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);
        $populator->addEntity(Adress::class, 45, [
            "longitude" => function() use ($generator) { return $generator->longitude(); },
            "latitude" => function() use ($generator) { return $generator->latitude(); },
            "numero" => function() use ($generator) { return $generator->randomDigitNotNull(); },
            "type_street" => function() use ($generator) { return $generator->streetSuffix(); },
            "post_code" => function() use ($generator) { return $generator->randomNumber(5); },
            "street" => function() use ($generator) { return $generator->streetName(); },
            "country" => function() use ($generator) { return $generator->country(); },
        ]);
        $populator->addEntity(Users::class, 30, [
            "firstname" => function() use ($generator) { return $generator->firstName(); },
            "lastname" => function() use ($generator) { return $generator->lastName(); },
            "email" => function() use ($generator) { return $generator->email(); },
            "username" => function() use ($generator) { return $generator->username(); },
            "description" => function() use ($generator) { return $generator->text(200); },
            "image" => function() use ($generator) { return $generator->imageUrl(); },
            "password" => function() use ($generator) { return $generator->password() ;},
            "distanceKM" => function() use ($generator) { return $generator->randomNumber(3); },
        ]); 
        $populator->addEntity(Groups::class, 10, [
            "name" => function() use ($generator) { return $generator->country(); },
            "description" => function() use ($generator) { return $generator->realText(150); },
            
            "slug" => function() use ($generator) { return $generator->slug(); },
        ]);
        $populator->addEntity(Event::class, 10, [
            "name" => function() use ($generator) { return $generator->realText(15); },
            "description" => function() use ($generator) { return $generator->realText(150); },
            "date" => function() use ($generator) { return $generator->datetimeAD(); },
            "slug" => function() use ($generator) { return $generator->slug(); },
        ]);
       
        
       
        
        $populator->addEntity(Category::class, 10, [
            "name" => function() use ($generator) { return $generator->sentence(); },
            "description" => function() use ($generator) { return $generator->realText(150); },
        ]);
        $populator->addEntity(Comment::class, 40, [
            "content" => function() use ($generator) { return $generator->realText(); },
        ]);
        
        
        $inserted = $populator->execute();


        //generated lists for event_category
        $events = $inserted['App\Entity\Event'];
        $categories = $inserted['App\Entity\Category'];

        foreach ($events as $event) {
            shuffle($categories);
            $event->addCategory($categories[0]);
            $event->addCategory($categories[1]);
            $event->addCategory($categories[2]);
            $manager->persist($event);
        }


        //custom alerts 
        $userss = $inserted['App\Entity\Users'];
        $alertNames = ['eventCreate', 'eventEdit', 'eventDelete', 'eventComment'];

        foreach ($alertNames as $alertName){
            $alert = new Alert();
            $alert->setName($alertName);
            $alert->setDescription('alert description in few words');
            $alerts[]= $alert;
            $manager->persist($alert);
        }
        foreach ($userss as $user){
            foreach ($alerts as $alertToPut){
                
                $subscription = new Subscription();
                $subscription->setUsers($user);
                $subscription->setAlert($alertToPut);
                $subscription->setHasSubscribed(true);
                $manager->persist($subscription);
            }
            
        }


        //generated lists for groups_users
        $groupss = $inserted['App\Entity\Groups'];

        foreach ($groupss as $group) {
            shuffle($userss);
            $group->addUsers($userss[0]);
            $userss[0]->addGroups($group);
            $group->addUsers($userss[1]);
            $userss[1]->addGroups($group);
            $group->addUsers($userss[2]);
            $userss[2]->addGroups($group);
            $manager->persist($group);
            $manager->persist($userss[0]);
            $manager->persist($userss[1]);
            $manager->persist($userss[2]);

        }

        //Each event is related to one Group
        $userss = $inserted['App\Entity\Users'];
        $events = $inserted['App\Entity\Event'];

        foreach ($events as $event) {
            $eventGroup = $event->getGroups(); 
            $usersOfGroup = $eventGroup->getUsers(); 
            foreach ($usersOfGroup as $user){
                $userEventParticipation = new UserEventParticipation();
                $userEventParticipation->setEvent($event);
                $userEventParticipation->setUsers($user);
                $userEventParticipation->setHasAccepted(true);
                $manager->persist($userEventParticipation);
            }   
        } 
        $manager->flush();
    }
}