<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder= $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        // $user = new User();
        // $user->setUsername('hsayen97');
        // $user->setFullname('hsayen HDM');
        // $user->setEmail('hsayen.HDM@gmail.com');
        // $user->setPassword(
        //     $this->passwordEncoder->encodePassword($user,'hsayen123')
        // );


        // $manager->persist($user);

        // $manager->flush();
    }
}
