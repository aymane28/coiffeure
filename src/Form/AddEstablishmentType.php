<?php

namespace App\Form;

use App\Entity\EstablishmentType;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class AddEstablishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name")
            ->add("address")
            ->add("description", TextareaType::class)
            ->add("opening")
            ->add("phoneNumber")
            ->add("service", EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
            ])
            ->add("establishmentType", EntityType::class, [
                'class' => EstablishmentType::class,
                'choice_label' => 'name'
            ])
            ->add("submit", SubmitType::class);
    }
}