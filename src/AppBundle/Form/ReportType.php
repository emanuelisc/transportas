<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array('widget' => 'single_text', 'attr' => array('class' => 'form-control ', 'style' => 'margin-bottom:15px')))
            ->add('route', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('depart_time', TimeType::class, array('label' => 'Departed from terminal', 'attr' => array('class' => 'form-control', 'style' => 'width: 50%; margin-bottom:15px')))
            ->add('arrive_time', TimeType::class, array('label' => 'Arrived to client', 'attr' => array('class' => 'form-control', 'style' => 'width: 50%; margin-bottom:15px')))
            ->add('depart_km', IntegerType::class, array('label' => 'Mileage', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('unload_time', IntegerType::class, array('label' => 'Unloading time in minutes', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('arrive2_time', TimeType::class, array('label' => 'Arrived to terminal', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('depart2_time', TimeType::class, array('label' => 'Departed from client', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('arrive_km', IntegerType::class, array('label' => 'Mileage', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Report',
        ]);
    }
}