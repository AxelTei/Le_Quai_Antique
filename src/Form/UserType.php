<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", EmailType::class, [
                "label" => "Email",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 0, "max" => 180, "minMessage" => "Insérez votre Email.", "maxMessage" => "Votre identifiant ne doit pas dépasser 180 caractères !"]),
                    new NotBlank(["message" => "Veuillez saisir votre Email."])
                    ]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de Passe",
                "required" => true,
                "constraints" => [new NotBlank(["message" => "Veuillez saisir votre nouveau Mot de passe."])]
            ])
            ->add("confirm", PasswordType::class, [
                "label" => "Confirmer votre Mot de Passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Veuillez confirmer votre nouveau Mot de passe."]),
                    new Callback(['callback' => function ($value, ExecutionContext $ec)
                    {
                        if($ec->getRoot()['password']->getViewData() !== $value)
                        {
                                $ec->addViolation("Les mots de passe doivent être identique !");
                        }
                    }])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}