<?php

namespace App\Controller;

use App\Entity\Servicetype;
use App\Repository\CalendarRepository;
use App\Repository\EtablissementRepository;
use App\Repository\EtablissementtypeRepository;
use App\Repository\ServiceRepository;
use App\Repository\ServicetypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class EtablissementDetailsController extends AbstractController
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/etablissements/{slugetablissementtype}/{slugetablissement}", name="etablissement_details")
     */
    public function etablissementDetail(EtablissementRepository $etablissementRepository, $slugetablissementtype, $slugetablissement): Response
    {

        $etablissement = $etablissementRepository->findOneBy(['slug' => $slugetablissement]);
        //dd($etablissement);
        return $this->render('etablissement_details/etablissementdetails.html.twig', [
            'etablissement' => $etablissement
        ]);
    }


    /**
     * @Route("/etablissements/{slugetablissementtype}/{slugetablissement}/{slugservice}/{slugservicetype}", name="etablissement_rdv")
     */
    public function rendezvous(ServicetypeRepository $servicetypeRepository, CalendarRepository $calendarRepository, EtablissementRepository $etablissementRepository, $slugetablissement, $slugservice, $slugservicetype, Request $request, $slugetablissementtype): Response
    {
        $etablissement = $etablissementRepository->findOneBy(['slug' => $slugetablissement]);


        $servicetype = $servicetypeRepository->findOneBy((['slug' => $slugservicetype]));

        $timeopen = $calendarRepository->findAll();

        $slugservice = $request->attributes->get('slugservice');

        return $this->render('date_heure/dateheure.html.twig', [
            'servicetype' => $servicetype,
            'etablissement' => $etablissement,
            'timeopen' => $timeopen,
            'slugservice' => $slugservice
        ]);
    }


    /**
     * @Route("/etablissements/{slugetablissementtype}/{slugetablissement}/{slugservice}/{slugservicetype}/payement", name="payement_choice")
     */
    public function payement(ServicetypeRepository $servicetypeRepository, EtablissementRepository $etablissementRepository, $slugservice, $slugservicetype, Request $request, $slugetablissement, $slugetablissementtype): Response
    {

        $etablissement = $etablissementRepository->findOneBy(['slug' => $slugetablissement]);

        $servicetype = $servicetypeRepository->findOneBy((['slug' => $slugservicetype]));

        $rdvdate = $request->request->get('dateinput');

        $rdvtime = $request->request->get('timeinput');

        return $this->render('service_type/servicetype.html.twig', [
            'servicetype' => $servicetype,
            'etablissement' => $etablissement,
            'rdvdate' => $rdvdate,
            'rdvtime' => $rdvtime,
        ]);
    }

    /**
     * @Route("/payement/valide", name="app_validation_payment")
     */
    public function validPayement()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('validation_payment/valipayedpayment.html.twig');
    }
}
