<?php

namespace App\Form;

use App\Entity\Meeting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('artist')
            ->add('description')
            ->add('coordinates')
            ->add('hour', ChoiceType::class, [
                'choices' =>[
                    "00h" => 0,
                    "01h" => 1, 
                    "02h" => 2,
                    "03h" => 3,
                    "04h" => 4,
                    "05h" => 5,
                    "06h" => 6,
                    "07h" => 7,
                    "08h" => 8,
                    "09h" => 9,
                    "10h" => 10,
                    "11h" => 11,
                    "12h" =>12,
                    "13h"=> 13,
                    "14h"=> 14,
                    "15h"=> 15,
                    "16h"=> 16,
                    "17h"=> 17,
                    "18h"=> 18,
                    "19h"=> 19,
                    "20h"=> 20,
                    "21h"=> 21,
                    "22h"=> 22,
                    "23h"=> 23,
                
                ]
            ])
            ->add('day', ChoiceType::class, [
                'choices'=> [
                    'Lundi' => 'Lundi', 
                    'Mardi' => 'Mardi', 
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Dimanche'=> 'Dimanche'
                ] 
            ]
            )
            ->add('Enregistrer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meeting::class,
        ]);
    }
}
