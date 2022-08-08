<?php

namespace App\DataFixtures;

use App\Entity\Salon;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Prophecy\Comparator\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    protected $passwordHasher;
    protected $slugger;
    public function __construct(UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger)
    {
        $this->passwordHasher=$passwordHasher;
        $this->slugger=$slugger;
    }


    public function load(ObjectManager $manager): void
    {
        $salons =[];
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
            $salon->setName("Salon numéro $i");
            $salon->setAdresse("$i avenue d'opéra");
            $salon->setDescription('Meilleur coiffeur de la ville, situé pas loin de la station de métro Opéra!');
            $salon->setSlug($this->slugger->slug($salon->getName()));

            //service
            $service= new service();
            $service->setCoupe("Pampadour");
            $service->setCoupe("Quiff");
            $service->setCoupe("Undercut");
            $service->setSoins("Points noirs");
            $service->setSoins("Détox");
            $service->setColoration("Couleur Stylist");
            //$service->setSlug($this->slugger->slug($service->getName()));

            $salons[]=$salon;
            foreach($salons as $salon){
                $service->addSalon($salon);
            }
            $manager->persist($user);
            $manager->persist($salon);
            $manager->persist($service);
        }



        $manager->flush();
    }
}
