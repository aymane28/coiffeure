<?php

namespace App\Controller\Stripe;

use App\Controller\Services\RdvService;
use App\Repository\SalonRepository;
use App\Repository\ServiceRepository;
use App\Repository\ServicetypeRepository;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;

class StripeCheckoutSessionController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout_session")
     */
    public function checkout(RdvService $rdvService, ServicetypeRepository $servicetypeRepository, SalonRepository $salonRepository, ServiceRepository  $serviceRepository)
    {

        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        Stripe::setApiKey('sk_test_51LgyVyCBvyNjF9Db7NwDCHwRGg7WoVGoMGG9IXsRJpeuMQBr31dmggShwYxMxqclexdPL8XmUpe9qgHZgSgRF4jf00TFewgS7J');

        $checkout_session = Session::create([
            'customer_email' => $user -> getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [[
               'price_data'=>[
                   'currency' => 'eur',
                   'product_data' => [
                       'name' => 'tchirt'
                   ],
                   'unit_amount' => 200
               ],
                'quantity' =>1
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('rdv_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('rdv_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        //dd($checkout_session);
        return $this->redirect($checkout_session->url, 303);
    }

    /**
     * @Route("/checkout/validation", name="rdv_success")
     */
    public function rdvSuccess(){

        return $this->render('stripe/stripe_success/validation.html.twig');
    }

    /**
     * @Route("/checkout/annulation", name="rdv_cancel")
     */
    public function rdvCancel(){

        return $this->render('stripe/stripe_cancel/annulation.html.twig');
    }
}
