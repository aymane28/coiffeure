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
        $this->passwordHasher = $passwordHasher;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR'); // Create a Faker instance
        $establishment = [];
        $serviceTypes = [];
        $establishments = [];
        for ($i = 1; $i < 6; $i++) {
            $user = new user();
            $plaintextPassword = "password";
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user->setFirstName("firstName$i");
            $user->setLastName("lastName$i");
            $user->setEmail("email$i@gmail.com");
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setPhoneNumber($faker->phoneNumber);


            //etablissements
            $establishment = new Establishment();
            $establishment->setName($faker->randomElement(['Salon de Beauté Rétro Chic', 'Spa Urbain Zen', 'Barbier Traditionnel Parisien', 'Institut de Beauté de Luxe']));
            $establishment->setAddress("$i Av. de l'Opéra");
            $establishment->setDescription($faker->randomElement(['Reconnectez-vous avec votre bien-être intérieur dans notre spa urbain zen. Notre oasis de tranquillité en 
            plein cœur de la ville vous propose une évasion du quotidien. Détendez-vous avec nos massages apaisants, soins du visage luxueux et rituels de détente. 
            Notre équipe de thérapeutes qualifiés veillera à ce que vous vous sentiez revigoré et rajeuni. Profitez de notre espace de relaxation paisible et découvrez 
            une sérénité totale. Prenez du temps pour vous, redécouvrez l\'harmonie de l\'esprit et du corps dans notre spa urbain zen.', 'Pour une expérience de rasage 
            classique et de coiffure à l\'ancienne, visitez notre barbier traditionnel parisien. Notre équipe de maîtres barbiers est dédiée à la création de looks élégants 
            pour les gentlemen modernes. De la coupe de cheveux classique à la taille de barbe précise, nous mettons l\'accent sur les détails. Profitez de notre rasage à 
            l\'ancienne avec des serviettes chaudes et des produits de qualité. Plongez dans une atmosphère masculine authentique et découvrez le charme intemporel du rasage traditionnel.']));
            $establishment->setSlug($this->slugger->slug($establishment->getName()));
            $establishment->setOpening($faker->randomElement(['open', 'closed']));
            $establishment->setPhoneNumber("0766666666");
            $establishment->setCreatedBy($user);

            //service
            $service = new service();
            $service->setName("Soin");
            $service->setSlug($this->slugger->slug($service->getName()));

            //serviceType
            $serviceType = new ServiceType();
            $serviceType->setName($faker->randomElement(['Pampadour', 'Quiff', 'Points noirs', 'Détox', 'Frange', 'Couleur Stylist']));
            $serviceType->setPrice($faker->randomElement(['20', '30', '60']));
            $serviceType->setTime($faker->randomElement(['30', '90', '45']));
            $serviceType->setSlug($this->slugger->slug($serviceType->getName()));


            //EstablishmentType
            $establishmentType = new EstablishmentType();
            $establishmentType->setName($faker->randomElement(['Barbier', 'Manucure', 'Spa']));
            $establishmentType->setSlug($this->slugger->slug($establishmentType->getName()));


            $establishments[] = $establishment;
            foreach ($establishments as $establishment) {
                $establishmentType->addEstablishment($establishment);
            }

            $establishments[] = $establishment;
            foreach ($establishments as $establishment) {
                $service->addEstablishment($establishment);
            }

            $serviceTypes[] = $serviceType;
            foreach ($serviceTypes as $serviceType) {
                $service->addServiceType($serviceType);
            }

            $manager->persist($user);
            $manager->persist($establishment);
            $manager->persist($service);
            $manager->persist($serviceType);
            $manager->persist($establishmentType);
        }

        //calendar
        for ($i = 0; $i < 23; $i++) {
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
