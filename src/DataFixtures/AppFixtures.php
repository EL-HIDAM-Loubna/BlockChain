<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder= $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
    }


    //load post    
     public function loadPosts(ObjectManager $manager){
        for ($i=0; $i <10 ; $i++) { 
            $post = new Post();
            $post->setTitle('this is my First Title'.rand(0,100));
            $post->setBody('this is mu First body'.rand(0,100));
            $post->setTime(new \DateTime());
            $post->setUser($this->getReference('hsayen123'));
            $manager->persist($post);
        }

        $manager->flush();
     }

    // load user
    public function loadUsers(ObjectManager $manager){
        $user = new User();
        $user->setUsername('hsayen97');
        $user->setFullname('hsayen HDM');
        $user->setEmail('hsayen.HDM@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user,'hsayen123')
        );

         $this->addReference('hsayen123',$user);
        $manager->persist($user);
        $manager->flush();
    }
}
