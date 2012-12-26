<?php

namespace Locator\QuittanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Locator\QuittanceBundle\Form\QuittanceItemType;

class QuittanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', null, array(
                'attr' => array('type' => 'number')
            ))
            ->add('dateStart', 'date', array('widget' => 'single_text'))
            ->add('dateEnd',   'date', array('widget' => 'single_text'))
            ->add('clauses')

            /*->add('items', 'collection', array(
                'type' => new QuittanceItemType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))*/
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
        return 'locator_quittancebundle_quittancetype';
    }
}
