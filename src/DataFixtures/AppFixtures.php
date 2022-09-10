<?php

namespace App\DataFixtures;

use App\Entity\Salon;
use App\Entity\Service;
use App\Entity\Servicetype;
use App\Entity\User;
use ContainerQYER1SZ\getServicetypeRepositoryService;
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
        $serviceTypes=[];
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
            $service->setName("coupe");
            $service->setName("Coloration");
            $service->setName("Soin");
            $service->setSlug($this->slugger->slug($service->getName()));

            //serviceType
            $serviceType= new servicetype();
            $serviceType->setName("Pampadour");
            $serviceType->setName("Quiff");
            $serviceType->setName("Undercut");
            $serviceType->setName("Points noirs");
            $serviceType->setName("Détox");
            $serviceType->setName("Couleur Stylist");
            $serviceType->setPrice("10 euros");
            $serviceType->setTime("30 min");
            $serviceType->setSlug($this->slugger->slug($serviceType->getName()));

            //$service->setSlug($this->slugger->slug($service->getName()));

            $salons[]=$salon;
            foreach($salons as $salon){
                $service->addSalon($salon);
            }

            $serviceTypes[]=$serviceType;
            foreach($serviceTypes as $serviceType){
                $service->addRelation($serviceType);
            }

            $manager->persist($user);
            $manager->persist($salon);
            $manager->persist($service);
            $manager->persist($serviceType);
        }
        $manager->flush();
    }
}
