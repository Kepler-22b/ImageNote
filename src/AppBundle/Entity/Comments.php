<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity (repositoryClass="AppBundle\Entity\Repository\CommentsRepository")
 * @ORM\Table (name = "comments")
 */
class Comments {

	/**
	 * @ORM\Column (type = "integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column (type = "string")
	 */
	protected $title;

	/**
	 * @ORM\Column (type = "text" )
	 */
	protected $comment;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $user;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $approved;

	/**
	 * @ORM\ManyToOne(targetEntity="Note", inversedBy="comments")
	 * @ORM\JoinColumn(name="note_id", referencedColumnName="id")
	 */
	protected $note;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $dateCreated;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $dateUpdated;

	public function __construct() {
		$this->setDateCreated( new \DateTime());
		$this->setDateUpdated( new \DateTime());
	}

	/**
	 * @ORM\PreUpdate
	 */
	public function setUpdatedValue() {
		$this->setDateUpdated( new \DateTime());
	}

	/**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Comments
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Comments
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return Comments
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Comments
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Comments
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}
