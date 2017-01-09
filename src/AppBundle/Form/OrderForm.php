<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 18.12.2016
 * Time: 23:30
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, array('label' => 'Adres:'))
            ->add('city', TextType::class, array('label' => 'Miasto:'))
            ->add('postCode', TextType::class, array('label' => 'Kod Pocztowy:'))
            ->add('receiver', TextType::class, array('label' => 'Odbiorca:'))
            ->add('receiverPhoneNumber', TextType::class, array('label' => 'Numer telefonu:'))
            ->add('submit', SubmitType::class, array('label' => 'Wyślij'))
            ->getForm();
    }
}