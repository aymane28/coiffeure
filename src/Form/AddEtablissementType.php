<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddEtablissementType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $service = new Service();
        $builder
            ->add("name")
            ->add("adresse")
            ->add("description")
            ->add("ouverture")
            ->add("phonenumber")
            ->add('service', $service->getName())
            ->add("submit", SubmitType::class);
    }

}