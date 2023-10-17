<?php

namespace App\Controller\Construction;

use App\Repository\EstablishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConstructionController extends AbstractController
{
    #[Route("/construction", name: "construction")]
    public function __invoke(): Response
    {
        return $this->render('construction/construction.html.twig');
    }

}