<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;
use AppBundle\Form\NoteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NoteController extends Controller {


	/**
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getNoteAction( $id ) {
		$post = [
			'id'    => $id,
			'title' => 'Post' . $id
		];

		return $this->render( 'AppBundle::post.html.twig', [ 'post' => $post ] );
	}


	/**
	 * @param null $id - Ідентифікатор батьківсього поста
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getNotesAction() {

		$posts = array(
			[
				'id'    => 5,
				'title' => 'Post1'
			],
			[
				'id'    => 15,
				'title' => 'Post2'
			],
			[
				'id'    => 4,
				'title' => 'Post3'
			]
		);

		return $this->render( 'AppBundle::posts.html.twig', [ 'posts' => $posts ] );
	}

	public function createNoteAction( Request $request ) {

		$note = new Note();
		$note->setDateCreated( new \DateTime() );

		$form = $this->createForm( NoteType::class, $note, [
			'action' => $this->generateUrl( 'post_create' ),
			'method' => 'post'
		] );

		$form->add('submit', SubmitType::class, ['label' => 'Create']);

		$form->handleRequest( $request );

		if ( $form->isSubmitted() ) {
			if ( $form->isValid() ) {

				$em = $this->getDoctrine()->getManager();
				$em->persist( $note );
				$em->flush();

				$this->get( 'session' )->getFlashBag()->add( 'msg', 'Your note has been created' );

				return $this->redirect( $this->generateUrl( 'post_create' ) );

			} else {
				$this->get( 'session' )->getFlashBag()->add( 'msg', 'Something went wrong' );
			}
		}


		return $this->render( 'AppBundle::create_post.html.twig', [
			'form' => $form->createView()
		] );
	}

	public function editNoteAction ($id, Request $request) {
		return $this->render('AppBundle::edit_post.html.twig');
	}

	private function _noteFormHandler() {

	}
}