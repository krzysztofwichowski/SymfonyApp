<?php

namespace AppBundle\Form;

use AppBundle\Entity\Alcohol;
use AppBundle\Entity\Groups;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AlcoholType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('price', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('alcoholicstrength', NumberType::class, [
                'label' => '% Alcohol',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('groups', EntityType::class, [
                'label' => 'Group',
                'class' => Groups::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('create', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-lg btn-primary'
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Alcohol::class,
        ));
    }
}
