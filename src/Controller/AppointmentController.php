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
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/establishments/{slugestablishment}/{slugservice}/{slugservicetype}", name="appointment")
     * @ParamConverter("establishment", options={"mapping": {"slugestablishment": "slug"}})
     * @ParamConverter("service", options={"mapping": {"slugservice": "slug"}})
     * @ParamConverter("serviceType", options={"mapping": {"slugservicetype": "slug"}})
     */
    public function __invoke(Establishment $establishment, Service $service, ServiceType $serviceType, CalendarRepository $calendarRepository, Request $request): Response
    {
        $timeopen = $calendarRepository->findAll();

        $slugservice = $request->attributes->get('slugservice');

        return $this->render('appointment/appointment.html.twig', [
            'servicetype' => $serviceType,
            'establishment' => $establishment,
            'timeopen' => $timeopen,
            'slugservice' => $slugservice
        ]);
    }
}