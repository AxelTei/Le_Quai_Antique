<?php

namespace App\Form;

use App\Entity\Formula;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class FormulaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("menuTitle", TextType::class, [
                "label" => "Titre du Menu", 
                "required" => true,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Le titre ne doit pas être vide !", 'maxMessage' => "Le titre ne doit pas faire plus de 150 caractères !"])]
                ])
            ->add("formulaDayTitle", TextType::class, [
                "label" => "Titre pour la Formule Diner",
                "required" => false,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Le titre ne doit pas être vide !", 'maxMessage' => "Le titre ne doit pas faire plus de 150 caractères !"])]
            ])
            ->add("formulaDayDescription", TextareaType::class, [
                "label" => "Description de la Formule Déjeuner", 
                "required" => false,
                "constraints" => [ new Length(['min' => 5, 'max' => 320, 'minMessage' => "La description ne doit pas faire moins de 5 caractères !", 'maxMessage' => "La description ne doit pas faire plus de 320 caractères !"])]
                ])
            ->add("formulaDayPrice", TextType::class, [
                "label" => "Prix de la Formule Déjeuner", 
                "required" => false,
            ])
            ->add("formulaNightTitle", TextType::class, [
                "label" => "Titre pour la Formule Diner",
                "required" => false,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Le titre ne doit pas être vide !", 'maxMessage' => "Le titre ne doit pas faire plus de 150 caractères !"])]
            ])
            ->add("formulaNightDescription", TextareaType::class, [
                "label" => "Description de la Formule Diner", 
                "required" => false,
                "constraints" => [ new Length(['min' => 5, 'max' => 320, 'minMessage' => "La description ne doit pas faire moins de 5 caractères !", 'maxMessage' => "La description ne doit pas faire plus de 320 caractères !"])]
                ])
            ->add("formulaNightPrice", TextType::class, [
                "label" => "Prix de la Formule Diner", 
                "required" => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Formula::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}