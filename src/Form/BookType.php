<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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