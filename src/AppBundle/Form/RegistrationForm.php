<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 16.10.2016
 * Time: 14:16
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', TextType::class, array('label' => 'Nick:'))
            ->add('pass', PasswordType::class, array('label' => 'Hasło:'))
            ->add('passSEC', PasswordType::class, array('label' => 'Powtórz hasło:'))
            ->add('email', EmailType::class, array('label' => 'Email:'))
            ->add('zarejestruj', SubmitType::class, array('label' => 'Zarejestruj'))
            ->getForm();
    }

}