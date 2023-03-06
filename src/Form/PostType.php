<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class, [
                "label" => "Titre", 
                "required" => false,
                "constraints" => [ new Length(['min' => 0, 'max' => 150, 'minMessage' => "Le titre ne doit être vide !", 'maxMessage' => "Le titre ne doit pas faire plus de 150 caractères !"])]
                ])
            ->add("content", TextareaType::class, [
                "label" => "Contenu", 
                "required" => true,
                "constraints" => [
                    new Length(['min' => 5, 'max' => 320, 'minMessage' => "Le message ne doit pas faire moins de 5 caractères !", 'maxMessage' => "Le message ne doit pas faire plus de 320 caractères !"]),
                    new NotBlank(['message' => 'Le message ne doit pas être vide !'])
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Post::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}