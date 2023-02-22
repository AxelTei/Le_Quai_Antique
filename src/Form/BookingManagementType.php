<?php

namespace App\Form;

use App\Entity\BookingManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingManagementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", DateType::class, [
                "label" => "Choisissez une date",
                "widget" => "choice", 
                "required" => true,
                "html5" => false,
                "input" => "string"
            ])
            ->add("hourStart", TimeType::class, [
                "label" => "Choisissez une horaire pour le run du Midi",
                "required" => true,
                "widget" => "choice",
                "input" => "string"
            ])
            ->add("hourEnd", TimeType::class, [
                "label" => "Choisissez une horaire pour le run du Soir",
                "required" => true,
                "widget" => "choice",
                "input" => "string"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => BookingManagement::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}