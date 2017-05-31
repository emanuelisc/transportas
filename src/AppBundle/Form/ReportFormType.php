<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', TextType::class, array('label' => false, 'attr' => array('class' => 'form-control hidden', 'style' => 'margin-bottom:15px')))
//            ->add('user', EntityType::class, array(
//                'class' => 'AppBundle:User',
//                'choice_label' => function ($user) {              //Norėjau su šituo daryti, bet paspaudus submit, negauna reikšmės ir rodo kad value is empty
//                    return $user->getName();},
//                'attr' => array('class' => '', 'style' => 'margin-bottom:15px')))
            ->add('month', ChoiceType::class, array(
                'choices'  => array(
                    'January' => 1,
                    'February' => 2,
                    'March' => 3,
                    'April' => 4,
                    'May' => 5,
                    'June' => 6,
                    'July' => 7,
                    'August' => 8,
                    'September' => 9,
                    'October' => 10,
                    'November' => 11,
                    'December' => 12,
                ),
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NULL,
        ]);
    }
}