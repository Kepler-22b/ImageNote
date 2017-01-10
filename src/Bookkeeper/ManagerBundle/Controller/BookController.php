<?php

namespace Bookkeeper\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Bookkeeper\ManagerBundle\Entity\Book;
use Bookkeeper\ManagerBundle\Form\BookType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookController extends Controller
{

    public function indexAction()
    {
        return $this->render('BookkeeperManagerBundle:Book:index.html.twig');
    }

    public function showAction($id)
    {
        return $this->render('BookkeeperManagerBundle:Book:show.html.twig', [
            'id' => $id
        ]);
    }

    public function newAction()
    {
        $book = new Book();

        $form = $this->createForm(BookType::class , $book, [
            'action' => $this->generateUrl('book_create'),
            'method' => 'POST'
        ]);
        $form->add('submit', SubmitType::class, ['label' => 'Create Book']);

        return $this->render('BookkeeperManagerBundle:Book:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function createAction(Request $request)
    {

    }

    public function editAction($id)
    {
        return $this->render('BookkeeperManagerBundle:Book:edit.html.twig');
    }

    public function updateAction(Request $request, $id)
    {

    }

    public function deleteAction($id)
    {

    }
}