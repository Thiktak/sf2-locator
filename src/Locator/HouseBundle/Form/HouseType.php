<?php

namespace Locator\HouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('header')
            ->add('address')
            ->add('description')
            ->add('surface')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\HouseBundle\Entity\House'
        ));
    }

    public function getName()
    {
        return 'locator_housebundle_housetype';
    }
}
