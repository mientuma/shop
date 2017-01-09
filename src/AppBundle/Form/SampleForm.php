<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 12.10.2016
 * Time: 19:26
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SampleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa'))
            ->add('submit', SubmitType::class, array('label' => 'Wyślij'))
            ->getForm();
    }
}

