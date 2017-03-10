<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;

class DefaultController extends Controller {

	public function indexAction() {
		$em = $this->getDoctrine()->getManager();

		$latestPosts = $em->createQueryBuilder()
			->select("u")
			->from(Note::class, "u")
			->addOrderBy("u.dateCreated", "DESC")
			->getQuery()
			->getResult();

		return $this->render( "AppBundle::index.html.twig", ["latestPosts" => $latestPosts] );
	}
}
