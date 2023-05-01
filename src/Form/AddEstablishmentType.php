<?php

namespace App\Form;

use App\Entity\EstablishmentType;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;

class AddEstablishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("name")
            ->add("address")
            ->add("description", TextareaType::class)
            ->add("opening")
            ->add("phoneNumber", TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^0[1-9](\d{8})$/',
                        'message' => 'Le numéro de téléphone doit être au format français et commencer par 0.'
                    ])
                ]
            ])
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