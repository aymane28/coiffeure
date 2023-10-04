<?php

namespace App\Controller\Music;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route("/music", name: "music")]
    public function __invoke(): Response
    {

        return $this->render('music/music.html.twig');
    }
}
