<?php

namespace App\Controller;

use App\Entity\Servicetype;
use App\Repository\CalendarRepository;
use App\Repository\SalonRepository;
use App\Repository\ServiceRepository;
use App\Repository\ServicetypeRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Intl\DateFormatter\IntlDateFormatter;

class SalonDetailsController extends AbstractController
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router= $router;
    }

    /**
     * @Route("/salons/{slug}", name="salon_details", defaults={"servicetypetime" = "null", "date" = "null" })
     */
    public function salondetail(SalonRepository $salonRepository, $slug, CalendarRepository $calendarRepository, Request $request): Response
    {
        $salon= $salonRepository->findOneBy(['slug' => $slug]);

        if(!$salon){
            throw $this->createNotFoundException("le salon n'existe pas");
        }
        $servicetypee = $calendarRepository ->findAll();

        $servicetypetime = $request->query->get('servicetypetime');
        return $this->render('salon_details/index.html.twig', [
            'salon' => $salon,
            'servicetypee' => $servicetypee,
            'servicetypetime' => $servicetypetime
        ]);
    }



    /**
     * @Route("/salons/{slug}/{slugservice}/{slugservicetype}", name="salon_rdv")
     * @param ServiceRepository $serviceRepository
     * @param ServicetypeRepository $servicetypeRepository
     * @param CalendarRepository $calendarRepository
     * @param SalonRepository $salonRepository
     * @param $slug
     * @param $slugservice
     * @param $slugservicetype
     * @return Response
     */
    public function rendezvous(ServiceRepository $serviceRepository, ServicetypeRepository $servicetypeRepository, CalendarRepository $calendarRepository, SalonRepository $salonRepository, $slug, $slugservice, $slugservicetype,  Request $request): Response
    {
        $salon= $salonRepository->findOneBy(['slug' => $slug]);
        $service= $serviceRepository->findOneBy(['slug' => $slugservice]);
        $servtype=$servicetypeRepository->findOneBy((['slug' => $slugservicetype]));

        if(!$service ){
            throw $this->createNotFoundException("Le service n'existe pas");
        }
        $servicetype = $calendarRepository ->findAll();

        //$rdvdate = $request->query->get('dateinput');

        $servicetypee = $calendarRepository ->findAll();

        $slugservice = $request->attributes->get('slugservice');
       // dd($request->request->get('dateinput'));
        //dd($request->request->get('horaireinput'));
        return $this->render('date_heure/dateheure.html.twig', [
            'servicetype' => $servicetype,
            'servtype' => $servtype,
            'salon' => $salon,
            'service' => $service,
            'id'=> $salon->getId(),
            'servicetypee' => $servicetypee,
            'slugservice' => $slugservice
        ]);
    }



    /**
     * @Route("/salons/{slug}/{slugservice}/{slugservicetype}/payement", name="payement_choice")
     * @param ServiceRepository $serviceRepository
     * @param ServicetypeRepository $servicetypeRepository
     * @param CalendarRepository $calendarRepository
     * @param SalonRepository $salonRepository
     * @param $slug
     * @param $slugservice
     * @param $slugservicetype
     * @return Response
     */
    public function payement(ServiceRepository $serviceRepository, ServicetypeRepository $servicetypeRepository, CalendarRepository $calendarRepository, SalonRepository $salonRepository, $slug, $slugservice, $slugservicetype,  Request $request): Response
    {

        $salon= $salonRepository->findOneBy(['slug' => $slug]);
        $service= $serviceRepository->findOneBy(['slug' => $slugservice]);
        $servtype=$servicetypeRepository->findOneBy((['slug' => $slugservicetype]));

        if(!$service ){
            throw $this->createNotFoundException("Le service n'existe pas");
        }
        $servicetype = $calendarRepository ->findAll();

        $rdvdate = $request->request->get('dateinput');

        $rdvtime = $request->request->get('timeinput');
        //dd($rdvtime);
        $slugserv = $request->query->get('slugservice');
        $servicetypee = $calendarRepository ->findAll();

        //dd($request);
        //dd($request->attributes->get('slugservice'));
       // dd($request->request->get('dateinput'));
        //dd($request->request->get('horaireinput'));


        return $this->render('service_type/servicetype.html.twig', [
            'servicetype' => $servicetype,
            'servtype' => $servtype,
            'salon' => $salon,
            'service' => $service,
            'id'=> $salon->getId(),
            'rdvdate' => $rdvdate,
            'rdvtime' => $rdvtime,
            'servicetypee' => $servicetypee,
        ]);
    }


    /**
     * @Route("/payement/valide", name="app_validation_payment")
     */
    public function validPayement(){

        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('validation_payment/validpayment.html.twig');
    }
}
