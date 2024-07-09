<?php

namespace App\Form;

use App\Entity\Commandes;
use App\Entity\Commercants;
use App\Entity\Factures;
use App\Entity\Paniers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('payer')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('id_paniers', EntityType::class, [
                'class' => Paniers::class,
                'choice_label' => 'id',
            ])
            ->add('id_commercants', EntityType::class, [
                'class' => Commercants::class,
                'choice_label' => 'id',
            ])
            // ->add('facture', EntityType::class, [
            //     'class' => Factures::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
