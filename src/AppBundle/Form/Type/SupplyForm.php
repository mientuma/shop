<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 23.01.2017
 * Time: 12:08
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Supply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class SupplyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('document', TextType::class, array(
                'label' => 'Dokument:'
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Wyślij'
            ));

        $builder->add('supplyProducts', CollectionType::class, array(
            'label' => 'Produkt',
            'entry_type' => SupplyProductsForm::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Supply::class,
        ));
    }
}