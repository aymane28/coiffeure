<?php

namespace App\Controller;

use App\Entity\ServiceType;
use App\Form\ServiceChoice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ServiceChoiceController extends AbstractController
{

    /**
     * @Route("/show/{id}", name="test")
     */
    public function show(Request $request, EntityManagerInterface $entityManager, $id){

        $servicetype= new ServiceType();

        $form = $this ->createForm(ServiceChoice::class, $servicetype);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($servicetype);

            $name = $form['name']->getData();
            //return new Response('lalaalal'. $name);
           /* return $this->render('servicechoice.html.twig', [
                'form' => $form ->createView()
            ]);*/

            return $this->redirectToRoute('etablissement_details', [
                'slug'=> $id
            ]);
        }

        return $this->render('servicechoice.html.twig', [
            'form' => $form ->createView()
        ]);
    }

}