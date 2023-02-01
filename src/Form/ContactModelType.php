<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactModelType extends AbstractType
{

    //configurer les champs du formulaire
    //le paramètre builder : permet de gérer les champs d'un formulaire
    //le paramètre options : contient des informations liées au formulaire
    //    email de type string   subject de type string   message de stype string
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'exemple@gmail.com']),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'votre sujet']),
                    new Length(['min' => 30]),
                ],
            ])
            ->add('message', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message']),
                    new Length(['min' => 130]),
                ],
            ])
        ;
    }

    //pour parametrer le formulaire
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}