<?php

namespace Locator\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objects
 *
 * @ORM\Table(name="house_object")
 * @ORM\Entity
 */
class Object
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Locator\HouseBundle\Entity\Room", inversedBy="objects")
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="smallint")
     */
    private $number;



    public function __toString()
    {
        return (string) $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Objects
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Objects
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
     * Set number
     *
     * @param integer $number
     * @return Objects
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set room
     *
     * @param \Locator\HouseBundle\Entity\Room $room
     * @return Object
     */
    public function setRoom(\Locator\HouseBundle\Entity\Room $room = null)
    {
        $this->room = $room;
    
        return $this;
    }

    /**
     * Get room
     *
     * @return \Locator\HouseBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}