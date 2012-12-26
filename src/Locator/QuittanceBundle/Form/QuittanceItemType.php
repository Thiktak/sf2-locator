<?php

namespace Locator\QuittanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuittanceItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('header')
            ->add('price')
            ->add('tenant')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\QuittanceBundle\Entity\QuittanceItem'
        ));
    }

    public function getName()
    {
        return 'locator_quittancebundle_quittanceitemtype';
    }
}
