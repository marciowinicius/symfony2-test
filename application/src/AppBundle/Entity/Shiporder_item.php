<?php
/**
 * Created by PhpStorm.
 * User: Márcio Winicius
 * Date: 23/06/2018
 * Time: 12:47
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="shiporder_item")
 */
class Shiporder_item
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Shiporder", inversedBy="items", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $shiporder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

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
     * Get the value of shiporder
     */
    public function getShiporder()
    {
        return $this->shiporder;
    }

    /**
     * Set the value of shiporder
     *
     * @return  self
     */
    public function setShiporder($shiporder)
    {
        $this->shiporder = $shiporder;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

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