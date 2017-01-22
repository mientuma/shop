<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 18.12.2016
 * Time: 23:30
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SupplyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('document', TextType::class, array('label' => 'Dokument:'))
            ->add('product1', EntityType::class, array(
                'label' => 'Produkt:',
                'class' => 'AppBundle\Entity\Products',
                'choice_label' => 'name'
            ))
            ->add('quantity', IntegerType::class, array(
                'label' => 'Ilość:'
            ))
            ->add('submit', SubmitType::class, array('label' => 'Wyślij'))
            ->getForm();
    }
}