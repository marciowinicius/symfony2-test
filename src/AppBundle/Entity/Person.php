<?php
/**
 * Created by PhpStorm.
 * User: Márcio Winicius
 * Date: 23/06/2018
 * Time: 12:44
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Person_phone", mappedBy="person")
     */
    private $phones;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of personname
     */
    public function getPersonName()
    {
        return $this->personname;
    }

    /**
     * Set the value of personname
     *
     * @return  self
     */
    public function setPersonName($personname)
    {
        $this->personname = $personname;

        return $this;
    }

    /**
     * Get the value of created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of updated
     *
     * @return  self
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }
}