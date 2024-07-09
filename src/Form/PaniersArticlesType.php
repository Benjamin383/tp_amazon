<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Paniers;
use App\Entity\PaniersArticles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaniersArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('deja_payer')
            ->add('id_paniers', EntityType::class, [
                'class' => Paniers::class,
                'choice_label' => 'id',
            ])
            ->add('id_articles', EntityType::class, [
                'class' => Articles::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaniersArticles::class,
        ]);
    }
}
