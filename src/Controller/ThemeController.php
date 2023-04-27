<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    /**
     * @Route("/test/theme", name="test_theme")
     */
    public function theme(){

        return $this->render('testtheme.html.twig');
    }
}