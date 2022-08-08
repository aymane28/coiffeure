<?php

namespace App\Controller;

use App\Repository\SalonRepository;
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
}
