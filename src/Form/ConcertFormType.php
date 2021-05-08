<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Concert;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'label' => 'Artiste',
                'required' => true,
                'placeholder' => '-- Sélectionner un artiste --',
            ])
            ->add('stage', EntityType::class, [
                'class' => Stage::class,
                'label' => 'Scène',
                'required' => true,
                'placeholder' => '-- Sélectionner une scène --',
            ])
            ->add('hour', ChoiceType::class, [
                'choices' => [
                    "12h" => 12,
                    "13h" => 13,
                    "14h" => 14,
                    "15h" => 15,
                    "16h" => 16,
                    "17h" => 17,
                    "18h" => 18,
                    "19h" => 19,
                    "20h" => 20,
                    "21h" => 21,
                    "22h" => 22,
                    "23h" => 23,
                    "00h" => 0,
                    "01h" => 1,
                    "02h" => 2,
                ],
                'label' => 'Heure',
                'required' => true,
                'placeholder' => '-- Sélectionner un horaire --',
            ])
            ->add(
                'day',
                ChoiceType::class,
                [
                    'choices' => [
                        'Lundi' => 'Lundi',
                        'Mardi' => 'Mardi',
                        'Mercredi' => 'Mercredi',
                        'Jeudi' => 'Jeudi',
                        'Vendredi' => 'Vendredi',
                        'Samedi' => 'Samedi',
                        'Dimanche' => 'Dimanche'
                    ],
                    'label' => 'Jour',
                    'required' => true,
                    'placeholder' => '-- Sélectionner un jour --',
                ]
            )
            // ->add('active', CheckboxType::class, [
            //     'label_attr' => [
            //         'class' => 'inline',
            //     ],
            //     'attr' => [
            //         'class' => 'inline',
            //     ],
            // ])
            // ->add('artist')
            ->add('Enregistrer', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
