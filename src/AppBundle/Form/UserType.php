<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => false, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('email', EmailType::class, array('label' => false, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('plainPassword', PasswordType::class, array('label' => false, 'attr' => array('class' => 'form-control showpassword')))
            ->add('role', ChoiceType::class, array(
                'label' => false,
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px'),
                'choices' => array(
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
        ]);
    }
}