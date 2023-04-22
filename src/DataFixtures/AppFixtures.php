<?php

namespace App\DataFixtures;

use App\Entity\Calendar;
use App\Entity\Etablissements;
use App\Entity\Etablissementtype;
use App\Entity\Etablissement;
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
        $etablissement =[];
        $serviceTypes=[];
        $etablissements=[];
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


            //etablissements
            $etablissement= new Etablissement();
            $etablissement->setName("Etablissement numéro $i");
            $etablissement->setAdresse("$i avenue d'opéra");
            $etablissement->setDescription('Meilleur coiffeur de la ville, situé pas loin de la station de métro Opéra!');
            $etablissement->setSlug($this->slugger->slug($etablissement->getName()));

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
            $serviceType->setPrice("10");
            $serviceType->setTime("30 min");
            $serviceType->setSlug($this->slugger->slug($serviceType->getName()));


            //Etablissementtype
            $etablissementtype = new etablissementtype();
            $etablissementtype->setName('Barbier');
            $etablissementtype->setSlug($this->slugger->slug($etablissementtype->getName()));


            $etablissements[]=$etablissement;
            foreach($etablissements as $etablissement){
                $etablissementtype->addEtablissement($etablissement);
            }

            $etablissements[]=$etablissement;
            foreach($etablissements as $etablissement){
                $service->addEtablissement($etablissement);
            }

            $serviceTypes[]=$serviceType;
            foreach($serviceTypes as $serviceType){
                $service->addServicetype($serviceType);
            }

            $manager->persist($user);
            $manager->persist($etablissement);
            $manager->persist($service);
            $manager->persist($serviceType);
            $manager->persist($etablissementtype);
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
