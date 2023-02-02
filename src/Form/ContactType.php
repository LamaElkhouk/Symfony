<?php

namespace App\Form;

use App\Entity\ContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'email is required']),
                    new Email(['message' => 'email is invalid']),
                ],
            ])
            ->add('subject', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'votre sujet']),
                    new Length(['min' => 5, 'max' => 30]),
                ],
            ])
            ->add('message', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message']),
                    new Length(['min' => 10, 'max' => 130]),
                ],
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactModel::class,
        ]);
    }
}