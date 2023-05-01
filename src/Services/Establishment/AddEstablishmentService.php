<?php

namespace App\Services\Establishment;

use App\Entity\Establishment;
use App\Form\AddEstablishmentType;
use App\Repository\ServiceRepository;
use App\Services\UserConnected;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class AddEstablishmentService
{
    public function __construct(private SluggerInterface              $slugger,
                                private EntityManagerInterface        $entityManager,
                                private RequestStack                  $request,
                                private ServiceRepository             $serviceRepository,
                                private AuthorizationCheckerInterface $authorizationChecker,
                                private UserConnected                 $userConnected,
                                private FormFactoryInterface $form)
    {
    }

    public function add()
    {
        $establishment = new Establishment();
        $form = $this->form(AddEstablishmentType::class, $establishment);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $establishment->setSlug($this->slugger->slug($establishment->getName()));
            $establishment->setCreatedBy($this->userConnected->getUserConnected());
            $this->entityManager->persist($establishment);
            $this->entityManager->flush();
            if ($establishment->getName() !== null) {
                return new RedirectResponse($this->generateUrl("establishment_details", [
                    'slugestablishment' => $establishment->getSlug()
                ]));
            }
        }
    }
}