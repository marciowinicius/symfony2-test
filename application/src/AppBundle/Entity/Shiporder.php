<?php
/**
 * Created by PhpStorm.
 * User: Márcio Winicius
 * Date: 23/06/2018
 * Time: 12:45
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder")
 */
class Shiporder
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Shiporder_item", mappedBy="shiporder")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="Shiporder_shipto", mappedBy="shiporder")
     */
    private $shipto;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->shipto = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $orderid;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $orderperson;

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
     * Get the value of orderid
     */
    public function getOrderId()
    {
        return $this->orderid;
    }

    /**
     * Set the value of orderid
     *
     * @return  self
     */
    public function setOrderId($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    /**
     * Get the value of orderperson
     */
    public function getOrderPerson()
    {
        return $this->orderperson;
    }

    /**
     * Set the value of orderperson
     *
     * @return  self
     */
    public function setOrderPerson($orderperson)
    {
        $this->orderperson = $orderperson;

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