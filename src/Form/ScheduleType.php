<?php

namespace App\Form;

use App\Entity\Schedules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", TextType::class, [
                "label" => "La date", 
                "required" => true,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Veuillez indiquer un jour de la semaine correspondant à vos nouvelles horaires.", 'maxMessage' => "Le jour indiqué ne doit pas faire plus de 150 caractères !"])]
                ])
            ->add("openingHoursDay", TextType::class, [
                "label" => "Horaires Déjeuner",
                "required" => false,
            ])
            ->add("openingHoursNight", TextType::class, [
                "label" => "Horaires Diner", 
                "required" => false,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Schedules::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}