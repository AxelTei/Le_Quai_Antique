<?php

namespace App\Form;

use App\Entity\BookingManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                "format" => "dd-MM-yyyy",
                "input" => "string"
            ])
            ->add("hourStart", DateTimeType::class, [
                "label" => "Choisissez une horaire",
                "required" => true,
                "widget" => "single_text",
                "html5" => false
            ])
            ->add("hourEnd", DateTimeType::class, [
                "label" => "Choisissez une horaire",
                "required" => true,
                "widget" => "single_text",
                "html5" => false
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