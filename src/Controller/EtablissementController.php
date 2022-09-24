<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Etablissementtype;
use App\Repository\EtablissementRepository;
use App\Repository\EtablissementtypeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    /**
     * @Route("/etablissements", name="type_etablissements")
     */
    public function etablissementType(EtablissementtypeRepository $etablissementTypeRepository): Response
    {
        $etablissementtype = $etablissementTypeRepository->findAll();

        return $this->render('etablissement/typeetablissement.html.twig', [
            'etablissementtype' => $etablissementtype,
        ]);
    }

    /**
     * @Route("/etablissements/{slugetablissementtype}", name="etablissements")
     */
    public function salon(EtablissementtypeRepository $etablissementtypeRepository, $slugetablissementtype): Response
    {
        $etablissementtype = $etablissementtypeRepository->findOneBy(['slug' => $slugetablissementtype]);

        //dd($etablissementtype);
        //$etablissement = $etablissementRepository->findByEtablissementType($etablissementtype);

        return $this->render('etablissement/etablissement.html.twig', [
            'etablissementtype' => $etablissementtype,
        ]);
    }
}
