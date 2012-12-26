<?php

namespace Locator\LeaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lease
 *
 * @ORM\Table(name="lease_contact")
 * @ORM\Entity
 */
class Contact
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
     * @ORM\ManyToOne(targetEntity="Locator\ContactBundle\Entity\Contact", inversedBy="lease")
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="Locator\LeaseBundle\Entity\Lease", inversedBy="contacts")
     */
    private $lease;

    /**
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(name="place", type="string")
     */
    private $place;
    

    public function __toString()
    {
        return (string) $this->getContact();
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
     * Set type
     *
     * @param string $type
     * @return Contact
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contact
     *
     * @param \Locator\ContactBundle\Entity\Contact $contact
     * @return Contact
     */
    public function setContact(\Locator\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return \Locator\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set lease
     *
     * @param \Locator\LeaseBundle\Entity\Lease $lease
     * @return Contact
     */
    public function setLease(\Locator\LeaseBundle\Entity\Lease $lease = null)
    {
        $this->lease = $lease;
    
        return $this;
    }

    /**
     * Get lease
     *
     * @return \Locator\LeaseBundle\Entity\Lease 
     */
    public function getLease()
    {
        return $this->lease;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Contact
     */
    public function setPlace($place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }
}