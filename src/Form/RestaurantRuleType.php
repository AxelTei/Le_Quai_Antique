<?php

namespace App\Form;

use App\Entity\RestaurantRule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RestaurantRuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("closureDay", TextType::class, [
                "label" => "Précisez la\\les date(s) de fermeture(s) du restaurant :",
            ])
            ->add("runMidi", ChoiceType::class, [
                "label" => "A quelle heure voulez-vous que le restaurant commence son run de mi-journée ?",
            ])
            ->add("runSoir", ChoiceType::class, [
                "label" => "A quelle heure voulez-vous que le restaurant commence son run du soir ?",
            ])
            ->add("bookingLimit", ChoiceType::class, [
                "label" => "Précisez la limite de réservation par jour :",
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