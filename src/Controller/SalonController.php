<?php

namespace App\Controller;

use App\Repository\SalonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalonController extends AbstractController
{
    /**
     * @Route("/salons", name="salons")
     */
    public function salon(SalonRepository $salonRepository): Response
    {
        $salon = $salonRepository ->findAll();
        return $this->render('salon/salon.html.twig', [
            'salon' => $salon,
        ]);
    }
}
