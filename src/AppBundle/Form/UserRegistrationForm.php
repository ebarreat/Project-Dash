<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationForm extends AbstractType{
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('username', TextType::class)
      ->add('plain_password', RepeatedType::class,['type' => PasswordType::class]);
    
    
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => User::class
    ]);
  }
}