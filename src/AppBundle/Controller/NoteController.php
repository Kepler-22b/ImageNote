<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;

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

	public function createNoteAction () {
	    return $this->render('AppBundle::create_post.html.twig');
    }
}