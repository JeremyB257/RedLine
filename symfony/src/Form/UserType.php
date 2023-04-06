<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'label' => 'Civilité :',
                'choices' => [
                    'Mme' => true,
                    'M.' => false,
                ],
                'expanded' => true,
                'attr' => [
                    'class' => 'd-flex gap-3',
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('firstname', null, [
                'label' => 'Prénom :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],

            ])
            ->add('lastname', null, [
                'label' => 'Nom :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('number_adress', null, [
                'label' => 'n° :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('street1', null, [
                'label' => 'Rue :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('street2', null, [
                'label' => 'Complément :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('postcode', null, [
                'label' => 'Code postal :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('city', null, [
                'label' => 'Ville :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('country', null, [
                'label' => 'Pays :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('email', null, [
                'label' => 'Email :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('phoneNumber', null, [
                'label' => 'n° de téléphone :',
                'attr' => [
                    'class' => 'p-1'
                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance :',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'p-1',

                ],
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            ->add('newsletter', null, [
                'label' => 'Newsletter',
                'label_attr' => [
                    'class' => 'fw-bold',
                ],
            ])
            // ->add('password')
            // ->add('fidelity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
