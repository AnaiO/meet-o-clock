<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $has_subscribed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Alert")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alert;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHasSubscribed(): ?bool
    {
        return $this->has_subscribed;
    }

    public function setHasSubscribed(bool $has_subscribed): self
    {
        $this->has_subscribed = $has_subscribed;

        return $this;
    }

    public function getAlert(): ?Alert
    {
        return $this->alert;
    }

    public function setAlert(?Alert $alert): self
    {
        $this->alert = $alert;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
