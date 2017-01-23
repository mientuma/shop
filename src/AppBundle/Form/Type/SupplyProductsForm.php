<?php

/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 23.01.2017
 * Time: 12:02
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\SupplyProducts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplyProductsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productPrice');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SupplyProducts::class,
        ));
    }
}