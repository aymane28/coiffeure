<?php

namespace App\Controller;

use App\Repository\SalonRepository;
use App\Repository\ServiceRepository;
use App\Repository\ServicetypeRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalonDetailsController extends AbstractController
{
    /**
     * @Route("/salon/{slug}", name="salon_details")
     */
    public function salondetail(SalonRepository $salonRepository, $slug): Response
    {
        $salon= $salonRepository->findOneBy(['slug' => $slug]);

        if(!$salon){
            throw $this->createNotFoundException("le salon n'existe pas");
        }
        //$doctrine=$doctrine->getRepository(Salon::class)->findBy($slug);
        return $this->render('salon_details/index.html.twig', [
            'salon' => $salon
        ]);
    }


    /**
     * @Route("/salon/{slug}/{slugservice}/{slugservicetype}", name="salon_details")
     */
    public function rendezvous(ServiceRepository $serviceRepository,ServicetypeRepository $servicetypeRepository ,$slug, $slugservice, $slugservicetype): Response
    {
        $service= $serviceRepository->findOneBy(['slug' => $slugservice]);
        $servicetype=$servicetypeRepository->findOneBy((['slug' => $slugservicetype]));

        if(!$service ){
            throw $this->createNotFoundException("Le service n'existe pas");
        }
        //$doctrine=$doctrine->getRepository(Salon::class)->findBy($slug);
        return $this->render('service_type/servicetype.html.twig', [
            'servicetype' => $servicetype
        ]);
    }

}
