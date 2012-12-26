<?php

namespace Locator\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="house_room")
 * @ORM\Entity
 */
class Room
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
     * @ORM\ManyToOne(targetEntity="Locator\HouseBundle\Entity\House", inversedBy="rooms")
     */
    private $house;

    /**
     * @ORM\OneToMany(targetEntity="Locator\HouseBundle\Entity\Object", mappedBy="room")
     */
    private $objects;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="length", type="integer")
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * @return Room
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
     * Set width
     *
     * @param integer $width
     * @return Room
     */
    public function setWidth($width)
    {
        $this->width = $width;
    
        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return Room
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Room
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
     * Constructor
     */
    public function __construct()
    {
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set house
     *
     * @param \Locator\HouseBundle\Entity\House $house
     * @return Room
     */
    public function setHouse(\Locator\HouseBundle\Entity\House $house = null)
    {
        $this->house = $house;
    
        return $this;
    }

    /**
     * Get house
     *
     * @return \Locator\HouseBundle\Entity\House 
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Add objects
     *
     * @param \Locator\HouseBundle\Entity\Object $objects
     * @return Room
     */
    public function addObject(\Locator\HouseBundle\Entity\Object $objects)
    {
        $this->objects[] = $objects;
    
        return $this;
    }

    /**
     * Remove objects
     *
     * @param \Locator\HouseBundle\Entity\Object $objects
     */
    public function removeObject(\Locator\HouseBundle\Entity\Object $objects)
    {
        $this->objects->removeElement($objects);
    }

    /**
     * Get objects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObjects()
    {
        return $this->objects;
    }
}