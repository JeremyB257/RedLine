<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civility', null, [
                'label' => 'Civilité',
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
            ])
            ->add('number_adress', null, [
                'label' => 'n°',
            ])
            ->add('street1', null, [
                'label' => 'Rue',
            ])
            ->add('street2', null, [
                'label' => 'Complément',
            ])
            ->add('postcode', null, [
                'label' => 'Code postal',
            ])
            ->add('city', null, [
                'label' => 'Ville',
            ])
            ->add('country', null, [
                'label' => 'Pays',
            ])
            ->add('email', null, [
                'label' => 'Email',
            ])
            ->add('phoneNumber', null, [
                'label' => 'n° de téléphone',
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance',
                'widget'=> 'single_text',
            ])
            ->add('newsletter', null, [
                'label' => 'Newsletter',
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
