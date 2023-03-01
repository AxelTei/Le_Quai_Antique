<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Context\ExecutionContext;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", EmailType::class, [
                "label" => "Email*",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 0, "max" => 180, "minMessage" => "Insérez votre Email.", "maxMessage" => "Votre identifiant ne doit pas dépasser 180 caractères !"]),
                    new NotBlank(["message" => "Veuillez saisir votre Email."])
                    ]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de Passe*",
                "required" => true,
                "constraints" => [new NotBlank(["message" => "Veuillez saisir votre nouveau Mot de passe."])]
            ])
            ->add("confirm", PasswordType::class, [
                "label" => "Confirmer votre Mot de Passe*",
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
            ])
            ->add("alias", TextType::class, [
                "label" => "Votre nom ou un surnom par lequel vous aimeriez être appelé(e) ?",
                "required" => false,
                "constraints" => [
                    new Length(["min" => 0, "max" => 180, "minMessage" => "Veuillez inscrire un nom valide", "maxMessage" => "Votre nom ou surnom ne doit pas dépasser 180 caractères !"]),
                ]
            ])
            ->add("phoneNumber", TextType::class, [
                "label" => "Votre numéro de téléphone :",
                "required" => false,
                "constraints" => [
                    new Length(["min" => 2, "max" => 30, "minMessage" => "Veuillez inscrire un numéro valide", "maxMessage" => "Votre numéro ne doit pas dépasser 30 caractères !"]),
                ]
            ])
            ->add("preferedHour", TimeType::class, [
                "label" => "Sélectionez l'heure que vous préférez pour votre réservation",
                "required" => false,
                "input" => "string",
                "widget" => "single_text",
                "placeholder" => "Sélectionnez une heure"
            ])
            ->add("preferedGroupNumber", IntegerType::class, [
                "label" => "Vous réservez pour combien de personnes, habituellement ?",
                "required" => false,
                "empty_data" => 2,
            ])
            ->add("allergies", TextType::class, [
                "label" => "Avez-vous des allergies ?",
                "required" => false,
                "constraints" => [new Length(["min" => 1, "max" => 180, "minMessage" => "Insérez des véritables allergies.", "maxMessage" => "Vos allergies ne doivent pas dépasser 180 caractères ! Si elles dépassent, veuillez-nouc contacter téléphoniquement !"])]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Customers::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}