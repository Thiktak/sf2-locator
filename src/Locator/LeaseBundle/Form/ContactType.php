<?php

namespace Locator\LeaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact')
            ->add('lease')
            ->add('type', 'choice', array(
                'choices' => array(
                    'tenant' => 'Locataire',
                    'guarantor' => 'Garants',
                )
            ))
            ->add('birthplace')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\LeaseBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'locator_leasebundle_contacttype';
    }
}
