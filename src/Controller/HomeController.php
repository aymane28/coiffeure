<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "home")]
    public function acceuil(NotifierInterface $notifier): Response
    {
        $notification = new Notification('oui oui', ['chat/myMercureChatter']);
        $notifier->send($notification);

        return $this->render('home.html.twig');
    }
}