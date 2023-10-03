<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSettings extends AbstractController
{
    #[Route("/settings", name: "profil_settings")]
    public function view(SessionInterface $session): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $cart = $session->get('cart', []);

        return $this->render('user/profilsettings.html.twig', [
            'profil_settings' => 'ProfilSettings',
            'cart' => $cart
        ]);
    }
}