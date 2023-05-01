<?php

namespace App\Controller\Establishment;

use App\Entity\Establishment;
use App\Form\AddEstablishmentType;
use App\Repository\ServiceRepository;
use App\Services\UserConnected;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class AddEstablishmentController extends AbstractController
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->slugger = $slugger;
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route("/addEstablishment", name: "add_establishment")]
    public function __invoke(Request $request, ServiceRepository $serviceRepository, EntityManagerInterface $entityManager, UserConnected $userConnected): Response
    {
        $establishment = new Establishment();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $form = $this->createForm(AddEstablishmentType::class, $establishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $establishment->setSlug($this->slugger->slug($establishment->getName()));
            $establishment->setCreatedBy($userConnected->getUserConnected());
            $entityManager->persist($establishment);
            $entityManager->flush();
            if ($establishment->getName() !== null) {
                return new RedirectResponse($this->generateUrl("establishment_details", [
                    'slugestablishment' => $establishment->getSlug()
                ]));
            }
        }
        return $this->renderForm('establishment/addestablishment.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route("/payment/valide", name: "app_validation_payment")]
    public function validPayment(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        return $this->render('validation_payment/validpayment.html.twig');
    }
}