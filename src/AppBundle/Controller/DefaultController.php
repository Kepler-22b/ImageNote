<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Note;

class DefaultController extends Controller {

	public function indexAction() {
		$em = $this->getDoctrine()->getManager();
		$latestPosts = $em->getRepository(Note::class)->getLatestPosts(4);

		return $this->render( "AppBundle::index.html.twig", [ "latestPosts" => $latestPosts ] );
	}
}
