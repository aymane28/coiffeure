<?php

namespace App\Controller\Stripe;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeSuccessController extends AbstractController
{
    /**
     * @Route("/stripe/stripe/success", name="app_stripe_stripe_success")
     */
    public function index(): Response
    {
        return $this->render('stripe/stripe_success/etablissementdetails.html.twig', [
            'controller_name' => 'StripeSuccessController',
        ]);
    }
}
