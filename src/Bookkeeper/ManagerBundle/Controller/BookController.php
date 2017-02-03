<?php

namespace Bookkeeper\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bookkeeper\ManagerBundle\Entity\Book;
use Bookkeeper\ManagerBundle\Form\BookType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookController extends Controller {

	public function indexAction() {
		$em    = $this->getDoctrine()->getManager();
		$books = $em->getRepository( 'BookkeeperManagerBundle:Book' )->findAll();

		return $this->render( 'BookkeeperManagerBundle:Book:index.html.twig', [ 'books' => $books ] );
	}

	public function showAction( $id ) {
		$em   = $this->getDoctrine()->getManager();
		$book = $em->getRepository( 'BookkeeperManagerBundle:Book' )->find( $id );

		$deleteForm = $this->_deleteForm( $id );

		return $this->render( 'BookkeeperManagerBundle:Book:show.html.twig', [
			'book'       => $book,
			'deleteForm' => $deleteForm->createView()
		] );
	}

	public function newAction() {
		$book = new Book();

		$form = $this->createForm( BookType::class, $book, [
			'action' => $this->generateUrl( 'book_create' ),
			'method' => 'POST'
		] );
		$form->add( 'submit', SubmitType::class, [ 'label' => 'Create Book' ] );

		return $this->render( 'BookkeeperManagerBundle:Book:new.html.twig', [
			'form' => $form->createView()
		] );
	}

	public function createAction( Request $request ) {
		$book = new Book();

		$form = $this->createForm( BookType::class, $book, [
			'action' => $this->generateUrl( 'book_create' ),
			'method' => 'POST'
		] );
		$form->add( 'submit', SubmitType::class, [ 'label' => 'Create Book' ] );

		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist( $book );
			$em->flush();

			$this->get( 'session' )->getFlashBag()->add( 'msg', 'Your book has been created' );

			return $this->redirect( $this->generateUrl( 'book_show', [
				'id' => $book->getId()
			] ) );
		}

		$this->get( 'session' )->getFlashBag()->add( 'msg', 'Something went wrong' );

		return $this->render( 'BookkeeperManagerBundle:Book:new.html.twig', [
			'form' => $form->createView()
		] );

	}

	public function editAction( $id ) {
		$em   = $this->getDoctrine()->getManager();
		$book = $em->getRepository( 'BookkeeperManagerBundle:Book' )->find( $id );

		$form = $this->createForm( BookType::class, $book, array(
			'action' => $this->generateUrl( 'book_update', array( 'id' => $book->getId() ) ),
			'method' => 'PUT'
		) );

		$form->add( 'submit', SubmitType::class, array( 'label' => 'Update Book' ) );

		return $this->render( 'BookkeeperManagerBundle:Book:edit.html.twig', array(
			'form' => $form->createView(),
			'book' => $book
		) );
	}

	public function updateAction( Request $request, $id ) {
		$em   = $this->getDoctrine()->getManager();
		$book = $em->getRepository( 'BookkeeperManagerBundle:Book' )->find( $id );

		$form = $this->createForm( BookType::class, $book, array(
			'action' => $this->generateUrl( 'book_update', array( 'id' => $book->getId() ) ),
			'method' => 'PUT'
		) );

		$form->add( 'submit', SubmitType::class, array( 'label' => 'Update Book' ) );

		//обробка запиту що передається параметром Request $request
		$form->handleRequest( $request );

		//якщо валідно, запис в БД та редірект на сторінку запису
		if ( $form->isValid() ) {
			$em->flush();
			$this->get( 'session' )->getFlashBag()->add( 'msg', 'Book Updated' );

			return $this->redirect( $this->generateUrl( 'book_show', array( 'id' => $id ) ) );
		}

		//якщо не валідно повернення на форму з повідомелння про валідацію
		return $this->render( 'BookkeeperManagerBundle:Book:edit.html.twig', array(
			'form' => $form->createView(),
			'book' => $book
		) );
	}

	public function deleteAction( Request $request, $id ) {
		$deleteForm = $this->_deleteForm( $id );

		$deleteForm->handleRequest( $request );

		if ( $deleteForm->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$book = $em->getRepository('BookkeeperManagerBundle:Book')->find($id);
			$em->remove($book);
			$em->flush();

			$this->get('session')->getFlashBag()->add('msg', 'Book has been deleted');

			return $this->redirect($this->generateUrl('book'));
		}

		$this->get('session')->getFlashBag()->add('msg', 'I could not delete the book');

		return $this->redirect($this->generateUrl('book_show', ['id' => $id]));
	}

	private function _deleteForm( $id ) {
		return $this->createFormBuilder()
		            ->setAction( $this->generateUrl( 'book_delete', [ 'id' => $id ] ) )
		            ->setMethod( 'DELETE' )
		            ->add( 'submit', SubmitType::class, array( 'label' => 'Delete book' ) )
		            ->getForm();
	}
}