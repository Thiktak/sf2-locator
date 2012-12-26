<?php

namespace Locator\QuittanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuittanceItem
 *
 * @ORM\Table(name="quittance_item")
 * @ORM\Entity
 */
class QuittanceItem
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
     * @ORM\ManyToOne(targetEntity="Locator\QuittanceBundle\Entity\Quittance", inversedBy="items", cascade={"persist"})
     */
    private $quittance;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="string", length=255)
     */
    private $header;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;
    /* @TODO : decimal !! */

    /**
     * @var boolean
     *
     * @ORM\Column(name="tenant", type="boolean", nullable=true)
     */
    private $tenant = false;


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
     * @return QuittanceItem
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
     * Set price
     *
     * @param float $price
     * @return QuittanceItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quittance
     *
     * @param \Locator\QuittanceBundle\Entity\Quittance $quittance
     * @return QuittanceItem
     */
    public function setQuittance(\Locator\QuittanceBundle\Entity\Quittance $quittance = null)
    {
        $this->quittance = $quittance;
    
        return $this;
    }

    /**
     * Get quittance
     *
     * @return \Locator\QuittanceBundle\Entity\Quittance 
     */
    public function getQuittance()
    {
        return $this->quittance;
    }

    /**
     * Set tenant
     *
     * @param boolean $tenant
     * @return QuittanceItem
     */
    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
    
        return $this;
    }

    /**
     * Get tenant
     *
     * @return boolean 
     */
    public function isTenant()
    {
        return $this->tenant;
    }
}