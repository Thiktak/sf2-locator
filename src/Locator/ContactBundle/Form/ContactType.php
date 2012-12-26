<?php

namespace Locator\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lname')
            ->add('fname')
            ->add('lname')
            ->add('sex', 'choice', array(
                'choices' => array(1 => 'Homme', 0 => 'Femme')
            ))
            ->add('birthday', 'date', array('widget' => 'single_text'))
            ->add('birthplace')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Locator\ContactBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'locator_contactbundle_contacttype';
    }
}
