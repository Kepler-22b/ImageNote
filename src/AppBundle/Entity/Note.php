<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table (name = "note")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\NoteRepository")
 */
class Note {

	/**
	 * @ORM\Column (type = "integer" )
	 * @ORM\Id
	 * @ORM\GeneratedValue (strategy = "AUTO")
	 */
	protected $id;


	/**
	 * @ORM\Column
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2)
	 */
	protected $title;


	/**
	 * @ORM\Column (type = "datetime", name = "date_created")
	 */
	protected $dateCreated;


	/**
	 * @ORM\Column (type = "datetime", name = "date_modified")
	 */
	protected $dateModified;


	/**
	 * @ORM\Column (type = "text", nullable = true)
	 */
	protected $description;


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
     * @return Note
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Note
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
     * Set description
     *
     * @param string $description
     *
     * @return Note
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     *
     * @return Note
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
}
