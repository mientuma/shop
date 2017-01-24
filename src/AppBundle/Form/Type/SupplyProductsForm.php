<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 23.01.2017
 * Time: 12:02
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\SupplyProducts;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplyProductsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, array(
                'class' => 'AppBundle\Entity\Products',
                'choice_label' => 'name'
            ))
            ->add('productPrice', MoneyType::class, array(
                'currency' => 'PLN',
                'label' => 'Cena:'
            ))
            ->add('productQuantity', NumberType::class, array(
                'label' => 'Ilość:'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SupplyProducts::class,
        ));
    }
}