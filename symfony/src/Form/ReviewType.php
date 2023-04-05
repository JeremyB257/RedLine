<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('evaluation', ChoiceType::class, [
                'choices' => [
                    'Excellent' => '5',
                    'Tres bien' => '4',
                    'Bien' => '3',
                    'Faible' => '2',
                    'Mauvais' => '1',
                ],
            ])
            ->add('content', null, [
                'label' => 'Commentaire',
                'label_attr' => ['class' => 'mt-2']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
