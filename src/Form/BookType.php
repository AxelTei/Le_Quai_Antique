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
                "widget" => "single_text", 
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
                        "12:00" => "runMidi",
                        "12:15" => "runMidi",
                        "12:30" => "runMidi",
                        "12:45" => "runMidi",
                        "13:00" => "runMidi",
                        "13:15" => "runMidi",
                        "13:30" => "runMidi",
                    ],
                    "SOIR" => [
                        "19:00" => "runSoir",
                        "19:15" => "runSoir",
                        "19:30" => "runSoir",
                        "19:45" => "runSoir",
                        "20:00" => "runSoir",
                        "20:15" => "runSoir",
                        "20:30" => "runSoir"
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