<?php

namespace App\Controller\Establishment;

use App\Entity\Establishment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstablishmentDetailsController extends AbstractController
{
    #[Route("/establishments/{slugestablishment}", name: "establishment_details")]
    #[ParamConverter("establishment", options: ["mapping" => ['slugestablishment' => 'slug']])]
    public function __invoke(Establishment $establishment): Response
    {
        return $this->render('establishment/establishmentDetails.html.twig', [
            'establishment' => $establishment
        ]);
    }
}