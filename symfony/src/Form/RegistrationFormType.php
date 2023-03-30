<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label_attr' => [
                    'class' => 'form-label',
                    'label' => 'Email*',
                ],
                'attr' => [
                    'class' => 'form-control border-0 border-bottom rounded-0 p-0',
                ],
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type'=> PasswordType::class,
                'first_options'  => [
                    'label' => 'Mot de passe*',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => ['class' => 'form-control border-0 border-bottom rounded-0 p-0 mb-5'],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe*',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => ['class' => 'form-control border-0 border-bottom rounded-0 p-0'],
                ],
                'mapped' => false,
                
                'attr' => [
                    'autocomplete' => 'new-password',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                ])
                
            ->add('agreeTerms', CheckboxType::class, [
                'label'=> 'conditions générales',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
