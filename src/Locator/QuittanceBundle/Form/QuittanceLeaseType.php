<?php

namespace Locator\QuittanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuittanceLeaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lease')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\QuittanceBundle\Entity\Quittance'
        ));
    }

    public function getName()
    {
        return null;//'locator_quittancebundle_quittanceleasetype';
    }
}
