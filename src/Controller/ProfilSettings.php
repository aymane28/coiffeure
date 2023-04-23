<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSettings extends AbstractController
{
    /**
     * @Route("/settings", name="profil_settings")
     */
    public function view(){

        return $this->render('user/profilsettings.html.twig', [
            'profil_settings' => 'ProfilSettings',
        ]);

    }

}