<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoiffeurController extends AbstractController
{
    /**
     * @Route("/coiffeur", name="app_coiffeur")
     */
    public function coiffeur(): Response
    {
        return $this->render('coiffeur/coiffeur.html.twig', [
            'controller_name' => 'CoiffeurController',
        ]);
    }
}
