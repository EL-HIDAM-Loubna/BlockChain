<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;
    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title):void
    {
        $this->title = $title;
    }

    /**
     * @ORM\Column(type="text")
     */
    private $body;
    public function getBody(){
        return $this->body;
    }
    public function setBody($body):void
    {
        $this->body = $body;
    }

    /**
     * @ORM\Column(type="date")
     */
    private $time;
    public function getTime(){
        return $this->time;
    }

    public function setTime($time):void
    {
        $this->time = $time;
    }


   /**
    *@ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="posts")
    *@ORM\JoinColumn 
    */
    private $user;
    public function getUser(){
        return $this->user;
    }

    public function setUser($user): self{
        $this->user = $user;
        return $this;
    }
}
