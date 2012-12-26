<?php

namespace Locator\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
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
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=255)
     */
    private $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255)
     */
    private $lname;

    /**
     * @var integer
     *
     * @ORM\Column(name="sex", type="integer", length=1)
     */
    private $sex;

    /**
     * @var date
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="birthplace", type="string", nullable=true)
     */
    private $birthplace;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $date_created;

    /**
     * @ORM\OneToMany(targetEntity="Locator\LeaseBundle\Entity\Contact", mappedBy="contact")
     */
    private $lease;


    public function __construct() {
        $this->date_created = new \DateTime();
    }


    public function __toString() {
        return trim(sprintf('%s %s %s', $this->getSex() ? 'Mr.' : 'Mme', $this->getLname(), $this->getFname()));
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
     * Set fname
     *
     * @param string $fname
     * @return Contact
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    
        return $this;
    }

    /**
     * Get fname
     *
     * @return string 
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     * @return Contact
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    
        return $this;
    }

    /**
     * Get lname
     *
     * @return string 
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
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
     * Set date_created
     *
     * @param \DateTime $dateCreated
     * @return Contact
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;
    
        return $this;
    }

    /**
     * Get date_created
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Add lease
     *
     * @param \Locator\LeaseBundle\Entity\Contact $lease
     * @return Contact
     */
    public function addLease(\Locator\LeaseBundle\Entity\Contact $lease)
    {
        $this->lease[] = $lease;
    
        return $this;
    }

    /**
     * Remove lease
     *
     * @param \Locator\LeaseBundle\Entity\Contact $lease
     */
    public function removeLease(\Locator\LeaseBundle\Entity\Contact $lease)
    {
        $this->lease->removeElement($lease);
    }

    /**
     * Get lease
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLease()
    {
        return $this->lease;
    }

    /**
     * Set sex
     *
     * @param integer $sex
     * @return Contact
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return integer 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Contact
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set birthplace
     *
     * @param string $birthplace
     * @return Contact
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
    
        return $this;
    }

    /**
     * Get birthplace
     *
     * @return string 
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }
}