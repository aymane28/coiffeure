<?php

namespace App\Controller\Establishment;

use App\Repository\EstablishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstablishmentController extends AbstractController
{
    #[Route("/establishments", name: "establishments")]
    public function __invoke(EstablishmentRepository $establishmentRepository): Response
    {
        $establishments = $establishmentRepository->findAll();

        return $this->render('establishment/establishment.html.twig', [
            'establishments' => $establishments,
        ]);
    }
}
