<?php

namespace App\Form;

use App\Entity\LucrariEfectuate;
use App\Entity\TipAnimal;
use App\Form\TipAdminType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TipAnimalRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class LucrariAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nume', null, [
                'constraints' => [
                    new NotBlank([
                    'message' => 'Numele animalului este obligatoriu.'
                    ])
                ]
            ])
            ->add('imagine', FileType::class, [
                'label' => 'Imaginea',
                'mapped' => false,
            ]
            )
            ->add('tip', EntityType::class, [
                'class' => TipAnimal::class,
                'choice_label' => 'nume'
            ])
            ->add('submit', SubmitType::class, [
            'label' => "Adauga"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LucrariEfectuate::class,
        ]);
    }
}
