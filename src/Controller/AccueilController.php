<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccueilController extends AbstractController
{


    /**
     * @Route("/", name="accueil")
     * @param Request $request
     * @param $doctrine
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function visualise(Request $request, ManagerRegistry $doctrine){



        return $this->render('accueil.html.twig');
    }

}