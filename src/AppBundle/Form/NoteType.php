<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('description');
    }
    public function setDefaultOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Note'
        ]);
    }
}