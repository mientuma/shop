<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 15.11.2016
 * Time: 21:58
 */

namespace AppBundle\Form;

use AppBundle\Entity\Products;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductForm extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa:'))
            ->add('price', MoneyType::class, array(
                'label' => 'Cena:',
                'currency' => 'PLN',
                'invalid_message' => 'Podano niewłaściwą wartość.'
            ))
            ->add('description', TextareaType::class, array('label' =>'Opis:'))
            ->add('subCategory', EntityType::class, array(
                'label' => 'Podkategoria:',
                'class' => 'AppBundle\Entity\SubCategory',
                'choice_label' => 'name'
            ) )
            ->add('send', SubmitType::class, array('label' => 'Wyślij'))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Products::class,
        ));
    }

}