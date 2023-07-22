<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Entity\Service;
use App\Entity\ServiceType;
use App\Repository\CalendarRepository;
use App\Repository\EstablishmentTypeRepository;
use App\Repository\ServiceRepository;
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
        $year = date('Y'); // Récupère l'année en cours
        $datesOfYear = $this->generateDatesForYear($year);

        return $this->render('appointment/appointment.html.twig', [
            'servicetype' => $serviceType,
            'establishment' => $establishment,
            'timeopen' => $timeOpen,
            'dateOfYear' =>$datesOfYear
        ]);
    }


    private function generateDatesForYear(int $year): array
    {
        $startDate = new \DateTime($year . '-01-01');
        $endDate = new \DateTime($year . '-12-31');
        $interval = new \DateInterval('P1D');
        $datePeriod = new \DatePeriod($startDate, $interval, $endDate);

        $dates = [];
        foreach ($datePeriod as $date) {
            $dates[] = $date;
        }

        return $dates;
    }


    /**
     * @Route("/add-to-cart/{id}/{slugservicetype}/{slugservice}", name="add_to_cart")
     * @ParamConverter("service", options={"mapping": {"slugservice": "slug"}})
     * @ParamConverter("serviceType", options={"mapping": {"slugservicetype": "slug"}})
     */
    public function addToCart(ServiceRepository $serviceRepository, EstablishmentTypeRepository $establishmentTypeRepository, Establishment $establishment, ServiceType $serviceType, Service $service, Request $request, SessionInterface $session): Response
    {
        $rdvDate = $request->request->get('rdvDate');
        $rdvTime = $request->request->get('rdvTime');
        $rdvCollab = $request->request->get('rdvCollab');
        $session->remove('cart');
        $establishmentType = $establishmentTypeRepository->find(10);

        $cart = [
            'cart' => [
                'establishmentType' => $establishmentType,
                'establishment' => $establishment,
                'serviceType' => $serviceType,
                'service' => $service,
                'rdvDate' => $rdvDate,
                'rdvTime' => $rdvTime,
                'rdvCollab' => $rdvCollab
            ]
        ];
        $session->set('cart', $cart);

        return $this->redirectToRoute('cart');
    }
}