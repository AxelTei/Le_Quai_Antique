<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("dishTitle", TextType::class, [
                "label" => "Titre", 
                "required" => true,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Le titre ne doit être vide !", 'maxMessage' => "Le titre ne doit pas faire plus de 150 caractères !"])]
                ])
            ->add("dishCategory", TextType::class, [
                "label" => "Category",
                "required" => true,
                "constraints" => [ new NotBlank(['message' => 'La catégorie du plat doit être inscrite !'])]
            ])
            ->add("dishDescription", TextareaType::class, [
                "label" => "Description", 
                "required" => true,
                "constraints" => [
                    new Length(['min' => 5, 'max' => 320, 'minMessage' => "La description ne doit pas faire moins de 5 caractères !", 'maxMessage' => "La description ne doit pas faire plus de 320 caractères !"]),
                    new NotBlank(['message' => 'Le description ne doit pas être vide !'])
                ]
                ])
            ->add("dishPrice", TextType::class, [
                "label" => "Prix du plat", 
                "required" => true,
                "constraints" => [new NotBlank(['message' => 'Le prix doit être indiqué !'])]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Menu::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}