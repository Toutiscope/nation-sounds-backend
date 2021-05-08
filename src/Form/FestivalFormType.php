<?php

namespace App\Form;

use App\Entity\Festival;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FestivalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TypeTextType::class,     [
                'label' => 'Nom de l\'édition'
            ])
            ->add('description', TextareaType::class,     [
                'label' => 'Description',
                'attr' => [
                    'rows' => 6,
                ],
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Date du premier jour',
                'widget' => 'single_text',                
            ])
            ->add('endDate', DateType::class, [
                'label' => 'Date du dernier jour',
                'widget' => 'single_text',                
            ])
            ->add('coordinates', TypeTextType::class,     [
                'label' => 'Coordonnées GPS'
            ])
            ->add('address', TypeTextType::class,     [
                'label' => 'Adresse du festival'
            ])
            ->add('city', TypeTextType::class,     [
                'label' => 'Ville'
            ])
            ->add('postCode', TypeTextType::class,     [
                'label' => 'Code postal'
            ])
            ->add('contactMail', EmailType::class,     [
                'label' => 'Adresse email générale'
            ])
            ->add('globalInformations', TextareaType::class,     [
                'label' => 'Informations générales',
                'attr' => [
                    'rows' => 10,
                ],
            ])
            ->add('praticalInformations', TextareaType::class,     [
                'label' => 'Informations pratiques',
                'attr' => [
                    'rows' => 10,
                ],
            ])
            // ->add('artists')
            // ->add('faqs')
            // ->add('contacts')
            // ->add('partners')
            ->add('Enregistrer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Festival::class,
        ]);
    }
}
