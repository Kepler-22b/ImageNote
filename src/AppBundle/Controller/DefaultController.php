<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;

class DefaultController extends Controller {

	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$qb = $em->createQueryBuilder();

		$latestPosts = $qb->select( "note" )
		                  ->from( Note::class, "note" )
		                  ->addOrderBy( "note.dateCreated", "DESC" )
		                  ->setMaxResults(6)
		                  ->getQuery()
		                  ->getResult();

		return $this->render( "AppBundle::index.html.twig", [ "latestPosts" => $latestPosts ] );
	}
}
