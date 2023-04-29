<?php

namespace App\Controller;

use App\Entity\Establishment;

use App\Entity\User;
use App\Form\AddEstablishmentType;
use App\Repository\ServiceRepository;
use App\Services\UserConnected;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class AddEtablissementController extends AbstractController
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->slugger = $slugger;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route("/addEtablissement", name="add_etablissement")
     */
    public function __invoke(Request $request, ServiceRepository $serviceRepository, EntityManagerInterface $entityManager, UserConnected $userConnected): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $establishment = new Establishment();
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
}