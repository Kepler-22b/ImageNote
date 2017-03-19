<?php

namespace AppBundle\Entity\Repository;

/**
 * NoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoteRepository extends \Doctrine\ORM\EntityRepository {

	public function getLatestPosts( $limit = null ) {

		return $this->createQueryBuilder( "note" )
		            ->select( "note" )
		            ->addOrderBy( "note.dateCreated", "DESC" )
		            ->setMaxResults( $limit )
		            ->getQuery()
		            ->getResult();
	}
}