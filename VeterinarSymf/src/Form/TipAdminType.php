<?php

namespace App\Form;

use App\Entity\TipAnimal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TipAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nume', null, [
            'constraints' => [
               new NotBlank([
                   'message' => 'Tipul nu poate fi null.'
               ]),]
            ])
            ->add('submit', SubmitType::class, [
            'label' => "Adauga"
       ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TipAnimal::class,
        ]);
    }
}
