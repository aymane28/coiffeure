<?php

namespace App\Controller\Professional;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalController extends AbstractController
{
    #[Route("/professional", name: "professional")]
    public function __invoke(): Response
    {

        return $this->render('professional/professional.html.twig');
    }
}
