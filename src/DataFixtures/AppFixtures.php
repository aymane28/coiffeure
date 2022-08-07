<?php

namespace App\DataFixtures;

use App\Entity\Salon;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    protected $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher=$passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<10; $i++){
            $user = new user();
            $plaintextPassword="password";
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user ->setName("user$i");
            $user ->setEmail("email$i@gmail.com");

            //salon
            $salon= new salon();
            $salon->setName("Salon$i");
            $salon->setAdresse("$i avenue d'opéra");
            $salon->setDescription('Meilleur coiffeur de la ville, situé pas loin de la station de métro Opéra!');

            $manager->persist($user);
            $manager->persist($salon);
        }



        $manager->flush();
    }
}
