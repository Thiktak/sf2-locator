<?php

namespace Locator\LeaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LeaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('header')
            ->add('day_of_quittance')
            ->add('house',     null, array('required' => true))
            ->add('dateStart', null, array('widget' => 'single_text'))
            ->add('dateEnd',   null, array('widget' => 'single_text'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\LeaseBundle\Entity\Lease'
        ));
    }

    public function getName()
    {
        return 'locator_leasebundle_leasetype';
    }
}
