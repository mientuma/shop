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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, array('label' => 'Login:'))
            ->add('password', PasswordType::class, array('label' => 'Hasło:'))
            ->add('zaloguj', SubmitType::class, array('label' => 'Zaloguj'))
            ->getForm();
    }
}

