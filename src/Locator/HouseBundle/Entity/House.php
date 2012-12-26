<?php

namespace Locator\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * House
 *
 * @ORM\Table(name="house")
 * @ORM\Entity
 */
class House
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
     * @ORM\OneToMany(targetEntity="Locator\LeaseBundle\Entity\Lease", mappedBy="house")
     */
    private $leases;

    /**
     * @ORM\OneTOMany(targetEntity="Locator\HouseBundle\Entity\Room", mappedBy="house")
     */
    private $rooms;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="string", length=100)
     */
    private $header;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var decimal
     *
     * @ORM\Column(name="surface", type="integer")
     */
    private $surface;
    /* @TODO decimal(scale=2) */


    public function __toString() {
        return $this->getHeader();
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
     * Set header
     *
     * @param string $header
     * @return House
     */
    public function setHeader($header)
    {
        $this->header = $header;
    
        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return House
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return House
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
     * Set surface
     *
     * @param float $surface
     * @return House
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
    
        return $this;
    }

    /**
     * Get surface
     *
     * @return float 
     */
    public function getSurface()
    {
        return $this->surface;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->leases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add leases
     *
     * @param \Locator\LeaseBundle\Entity\Lease $leases
     * @return House
     */
    public function addLease(\Locator\LeaseBundle\Entity\Lease $leases)
    {
        $this->leases[] = $leases;
    
        return $this;
    }

    /**
     * Remove leases
     *
     * @param \Locator\LeaseBundle\Entity\Lease $leases
     */
    public function removeLease(\Locator\LeaseBundle\Entity\Lease $leases)
    {
        $this->leases->removeElement($leases);
    }

    /**
     * Get leases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLeases()
    {
        return $this->leases;
    }

    /**
     * Add rooms
     *
     * @param \Locator\HouseBundle\Entity\Room $rooms
     * @return House
     */
    public function addRoom(\Locator\HouseBundle\Entity\Room $rooms)
    {
        $this->rooms[] = $rooms;
    
        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \Locator\HouseBundle\Entity\Room $rooms
     */
    public function removeRoom(\Locator\HouseBundle\Entity\Room $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}