<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", DateType::class, [
                "label" => "Choisissez une date",
                "widget" => "single_text", 
                "required" => true,
                "format" => "EEEE-dd-MMMM-yyyy",
                "input" => "string"
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
            ->add("preferedHour", ChoiceType::class, [
                "label" => "Choisissez une horaire",
                "choices" => [
                    "MIDI" => [
                        "12:00",
                        "12:15",
                        "12:30",
                        "12:45",
                        "13:00",
                        "13:15",
                        "13:30",
                    ],
                    "SOIR" => [
                        "19:00",
                        "19:15",
                        "19:30",
                        "19:45",
                        "20:00",
                        "20:15",
                        "20:30"
                    ]
                ],
                "required" => true
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