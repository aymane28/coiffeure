<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class beforeaddestablishment extends AbstractController
{
    /**
     * @Route("/addEstablishmentPricing", name="add_etablissement_pricing")
     */
    public function view(){

        return $this->render('establishment/beforeaddestablishment.html.twig');
    }

}