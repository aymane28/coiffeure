<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Etablissements;
use App\Entity\EstablishmentType;
use App\Entity\Establishment;
use App\Entity\Service;
use App\Entity\ServiceType;
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
        $establishment =[];
        $serviceTypes=[];
        $establishments=[];
        for($i=0; $i<5; $i++){
            $user = new user();
            $plaintextPassword="password";
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user ->setFirstName("firstName$i");
            $user->setLastName("lastName$i");
            $user ->setEmail("email$i@gmail.com");
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setPhoneNumber('0766666666');


            //etablissements
            $establishment= new Establishment();
            $establishment->setName("Establishment numéro $i");
            $establishment->setAddress("$i avenue d'opéra");
            $establishment->setDescription('Meilleur coiffeur de la ville, situé pas loin de la station de métro Opéra!');
            $establishment->setSlug($this->slugger->slug($establishment->getName()));
            $establishment->setOpening("open");
            $establishment->setPhoneNumber("0766666666");
            $establishment->setCreatedBy($user);

            //service
            $service= new service();
            $service->setName("coupe");
            $service->setName("Coloration");
            $service->setName("Soin");
            $service->setSlug($this->slugger->slug($service->getName()));

            //serviceType
            $serviceType= new ServiceType();
            $serviceType->setName("Pampadour");
            $serviceType->setName("Quiff");
            $serviceType->setName("Undercut");
            $serviceType->setName("Points noirs");
            $serviceType->setName("Détox");
            $serviceType->setName("Couleur Stylist");
            $serviceType->setPrice("10");
            $serviceType->setTime("30 min");
            $serviceType->setSlug($this->slugger->slug($serviceType->getName()));


            //EstablishmentType
            $establishmentType = new EstablishmentType();
            $establishmentType->setName('Barbier');
            $establishmentType->setSlug($this->slugger->slug($establishmentType->getName()));


            $establishments[]=$establishment;
            foreach($establishments as $establishment){
                $establishmentType->addEstablishment($establishment);
            }

            $establishments[]=$establishment;
            foreach($establishments as $establishment){
                $service->addEstablishment($establishment);
            }

            $serviceTypes[]=$serviceType;
            foreach($serviceTypes as $serviceType){
                $service->addServiceType($serviceType);
            }

            $manager->persist($user);
            $manager->persist($establishment);
            $manager->persist($service);
            $manager->persist($serviceType);
            $manager->persist($establishmentType);
        }

        //calendar
        for($i=0; $i<23; $i++) {
            $calendar = new calendar();
            $calendar->setTime($i);
            $calendar->setCommentaire("defaut");
        }

        $calendar->setDate("13-09-2022");
        $calendar->setTime("10");


        $manager->persist($calendar);

        $manager->flush();
    }
}
