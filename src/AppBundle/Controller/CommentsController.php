<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comments;
use AppBundle\Form\CommentsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Comment controller.
 */
class CommentsController extends Controller {
	/**
	 * @param $noteId
	 * Rendering comments form
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function newAction( $noteId ) {
		$note = $this->getNote( $noteId );

		$comment = new Comments();
		$comment->setNote( $note );
		$form = $this->createForm( CommentsType::class, $comment , [
			'action' => $this->generateUrl('comment_create', ['noteId' => $noteId]),
			'method' => 'post'
		]);
		$form->add('submit', SubmitType::class, ['label' => 'Add comment']);

		return $this->render( 'AppBundle:comments:form.html.twig', array(
			'comment' => $comment,
			'form'    => $form->createView()
		) );
	}

	/**
	 * @param Request $request
	 * @param $noteId
	 * Handling comment form submit
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function createAction( Request $request, $noteId ) {
		$note = $this->getNote( $noteId );

		$comment = new Comments();
		$comment->setNote( $note );
		$form = $this->createForm( CommentsType::class, $comment, [
			'action' => $this->generateUrl('comment_create', ['noteId' => $noteId]),
			'method' => 'post'
		]);
		$form->add('submit', SubmitType::class, ['label' => 'Add comment']);
		$form->handleRequest( $request );

		if ( $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush();

			return $this->redirect( $this->generateUrl( 'post', array(
					'id' => $comment->getNote()->getId()
				) ) . '#comment-' . $comment->getId()
			);
		}

		return $this->render( 'AppBundle:comments:form.html.twig', array(
			'comment' => $comment,
			'form'    => $form->createView()
		) );
	}

	protected function getNote( $noteId ) {
		$em   = $this->getDoctrine()->getManager();
		$note = $em->getRepository( 'AppBundle:Note' )->find( $noteId );
		if ( ! $note ) {
			throw $this->createNotFoundException( 'Unable to find Blog post.' );
		}

		return $note;
	}

}