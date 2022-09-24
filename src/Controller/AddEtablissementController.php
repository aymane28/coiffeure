<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\AddEtablissementType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;


class AddEtablissementController extends AbstractController
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger=$slugger;
    }

    /**
     * @Route("/addEtablissement", name="add_etablissement")
     */
    public function addEtablissement(SluggerInterface $slugger, Request $request, ServiceRepository $serviceRepository, EntityManagerInterface $entityManager)
    {

        $etablissement = new Etablissement();
        $form = $this -> createForm(AddEtablissementType::class, $etablissement);
        $form->handleRequest($request);

        $service = $serviceRepository->findAll();

        //dd($service);
        if($form->isSubmitted() && $form->isValid()) {
            $etablissement->setSlug($this->slugger->slug($etablissement->getName()));
            $entityManager->persist($etablissement);
            $entityManager->flush();

        }

        return $this->renderForm('etablissement/addetablissement.html.twig', [
            'form' => $form,
            'service' => $service
        ]);

    }
}