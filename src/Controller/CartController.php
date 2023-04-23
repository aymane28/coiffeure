<?php

namespace App\Controller;

use App\Entity\Establishment;
use App\Entity\Service;
use App\Entity\ServiceType;
use App\Repository\EstablishmentRepository;
use App\Repository\ServiceTypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/establishments/{slugestablishment}/{slugservice}/{slugservicetype}/cart", name="cart")
     * @ParamConverter("establishment", options={"mapping": {"slugestablishment": "slug"}})
     * @ParamConverter("service", options={"mapping": {"slugservice": "slug"}})
     * @ParamConverter("serviceType", options={"mapping": {"slugservicetype": "slug"}})
     */
    public function __invoke(Establishment $establishment, Service $service, ServiceType $serviceType, Request $request): Response
    {
        $rdvdate = $request->request->get('dateinput');
        $rdvtime = $request->request->get('timeinput');

        return $this->render('cart/cart.html.twig', [
            'servicetype' => $serviceType,
            'establishment' => $establishment,
            'rdvdate' => $rdvdate,
            'rdvtime' => $rdvtime,
        ]);
    }
}