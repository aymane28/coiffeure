<?php

namespace App\Controller;

use App\Entity\Establishment;

use App\Form\AddEstablishmentType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    public function __invoke(Request $request, ServiceRepository $serviceRepository, EntityManagerInterface $entityManager): Response
    {
        $establishment = new Establishment();
        $form = $this -> createForm(AddEstablishmentType::class, $establishment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $establishment->setSlug($this->slugger->slug($establishment->getName()));
            $entityManager->persist($establishment);
            $entityManager->flush();
        }

        return $this->renderForm('establishment/addestablishment.html.twig', [
            'form' => $form,
        ]);
    }
}