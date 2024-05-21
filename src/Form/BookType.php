<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", DateType::class, [
                "label" => "Choisissez une date disponible :",
                "input" => "string",
                "widget" => "single_text",
                "required" => true,
                "html5" => false,
                "attr" => [
                    "class" => "js-datepicker"
                ],
                "constraints" => [
                    new NotBlank(["message" => "Vous devez indiquer une date pour la réservation !"])
                ]
            ])
            ->add("hourSelectedDay", ChoiceType::class, [
                "label" => "Vous réservez pour ce midi ?",
                "expanded" => true,
                "multiple" => false,
                "choices" => [
                    "12:00" => "12:00",
                    "12:15" => "12:15",
                    "12:30" => "12:30",
                    "12:45" => "12:45",
                    "13:00" => "13:00",
                    "13:15" => "13:15",
                    "13:30" => "13:30",
                    "reset" => "reset"
                ]
            ])
            ->add("hourSelectedNight", ChoiceType::class, [
                "label" => "Vous réservez pour ce soir ?",
                "expanded" => true,
                "multiple" => false,
                "choices" => [
                    "19:00" => "19:00",
                    "19:15" => "19:15",
                    "19:30" => "19:30",
                    "19:45" => "19:45",
                    "20:00" => "20:00",
                    "20:15" => "20:15",
                    "20:30" => "20:30",
                    "reset" => "reset"
                ]
            ])
            ->add("preferedGroupNumber", ChoiceType::class, [
                "label" => "Choisissez le nombre de convives pour cette réservation",
                "choices" => [
                    "1 couvert" => 1,
                    "2 couverts" => 2,
                    "3 couverts" => 3,
                    "4 couverts" => 4,
                    "5 couverts" => 5,
                    "6 couverts" => 6
                ],
                "required" => true
            ])
            ->add("alias", TextType::class, [
                "label" => "Votre nom :",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 0, "max" => 180, "minMessage" => "Veuillez inscrire un nom valide", "maxMessage" => "Votre nom ou surnom ne doit pas dépasser 180 caractères !"]),
                    new NotBlank(["message" => "Vous devez indiquer un nom pour la résservation !"])
                ]
            ])
            ->add("phoneNumber", TextType::class, [
                "label" => "Votre numéro de téléphone :",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 2, "max" => 30, "minMessage" => "Veuillez inscrire un numéro valide", "maxMessage" => "Votre numéro ne doit pas dépasser 30 caractères !"]),
                ]
            ])
            ->add("allergies", TextType::class, [
                "label" => "Avez-vous des allergies à nous indiquer ?",
                "required" => false,
                "constraints" => [
                    new Length(["min" => 1, "max" => 180, "minMessage" => "Insérez des véritables allergies.", "maxMessage" => "Vos allergies ne doivent pas dépasser 180 caractères ! Si elles dépassent, veuillez-nouc contacter téléphoniquement !"])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Book::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}