<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RedirectType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('source')
            ->add('destination')
            ->add('statusCode')
            ->add('count')
            ->add('lastAccessed')
        ;
    }

    public function getName()
    {
        return 'acme_demobundle_redirecttype';
    }
}
