<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", DateType::class, [
                "label" => "Choisissez une date",
                "widget" => "choice", 
                "required" => true,
                "html5" => false,
                "format" => "dd-MM-yyyy",
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
                        "12:00" => 1200,
                        "12:15" => 1215,
                        "12:30" => 1230,
                        "12:45" => 1245,
                        "13:00" => 1300,
                        "13:15" => 1315,
                        "13:30" => 1330,
                    ],
                    "SOIR" => [
                        "19:00" => 1900,
                        "19:15" => 1915,
                        "19:30" => 1930,
                        "19:45" => 1945,
                        "20:00" => 2000,
                        "20:15" => 2015,
                        "20:30" => 2030
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