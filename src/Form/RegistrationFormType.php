<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                // To add a termsAccepted field to the form, we need to set mapped option to false:
                'mapped' => false,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez définir un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit avoir minimum 6 caractères',
                            'max' => 50,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'required' => true,
                ],
            ])
            ->add('captcha', CaptchaType::class, [
                'label' => 'Captcha',
                'as_url' => true,
                'reload' => true,
                'invalid_message' => 'Le captcha est invalide'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
