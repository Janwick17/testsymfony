<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Market;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Name')
        ->add('Description')
        ->add('ValideDate', null, [
            'widget' => 'single_text'
        ])
        ->add('Client', EntityType::class, [
            'class' => Client::class,
'choice_label' => 'id',
        ])
        ->add('submit', SubmitType::class)
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Market::class,
        ]);
    }
}
