<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Entity\Service;
use App\Entity\ServiceType;
use App\Repository\CalendarRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/establishments/{slugestablishment}/{slugservice}/{slugservicetype}", name="appointment")
     * @ParamConverter("establishment", options={"mapping": {"slugestablishment": "slug"}})
     * @ParamConverter("service", options={"mapping": {"slugservice": "slug"}})
     * @ParamConverter("serviceType", options={"mapping": {"slugservicetype": "slug"}})
     */
    public function __invoke(Establishment $establishment, Service $service, ServiceType $serviceType, CalendarRepository $calendarRepository, Request $request, SessionInterface $session): Response
    {
        $timeOpen = $calendarRepository->findAll();

        return $this->render('appointment/appointment.html.twig', [
            'servicetype' => $serviceType,
            'establishment' => $establishment,
            'timeopen' => $timeOpen
        ]);
    }

    /**
     * @Route("/add-to-cart/{id}/{slugservicetype}/{slugservice}", name="add_to_cart")
     * @ParamConverter("service", options={"mapping": {"slugservice": "slug"}})
     * @ParamConverter("serviceType", options={"mapping": {"slugservicetype": "slug"}})
     */
    public function addToCart(Establishment $establishment, ServiceType $serviceType, Service $service, Request $request, SessionInterface $session): Response
    {
        $rdvDate = $request->request->get('rdvDate');
        $rdvTime = $request->request->get('rdvTime');
        $session->remove('cart');

        $cart = [
            $establishment->getId() => [
                'establishment' => $establishment,
                'serviceType' => $serviceType,
                'service' => $service,
                'rdvDate' => $rdvDate,
                'rdvTime' => $rdvTime
            ]
        ];

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }
}