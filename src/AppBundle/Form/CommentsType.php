<?php

namespace AppBundle\Form;

use AppBundle\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsType extends AbstractType {
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'user' )
			->add( 'comment' );
	}

	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			"data_class" => Comments::class
		] );
	}
}