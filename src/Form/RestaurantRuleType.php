<?php

namespace App\Form;

use App\Entity\RestaurantRule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;

class RestaurantRuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("closureDay", TextType::class, [
                "label" => "Précisez la\\les date(s) de fermeture(s) du restaurant :",
                "constraints" => [new Length(['min' => 2, 'minMessage' => 'Veuillez entrer un jour valide.'])]
            ])
            ->add("runMidi", TextType::class, [
                "label" => "A quelle heure voulez-vous que le restaurant commence son run de mi-journée ?",
                "constraints" => [new Length(['min' => 2, 'minMessage' => 'Veuillez entrer une heure valide.'])]
            ])
            ->add("runSoir", TextType::class, [
                "label" => "A quelle heure voulez-vous que le restaurant commence son run du soir ?",
                "constraints" => [new Length(['min' => 2, 'minMessage' => 'Veuillez entrer une heure valide.'])]
            ])
            ->add("bookingLimit", IntegerType::class, [
                "label" => "Précisez la limite de réservation par jour :",
                "constraints" => [new Type(['message' => 'Veuillez entrer un numéro.', "type" => "integer"])]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => RestaurantRule::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}