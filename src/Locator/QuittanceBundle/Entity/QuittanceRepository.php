<?php

namespace Locator\QuittanceBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
 
class QuittanceRepository extends EntityRepository{

  public function findLastByLease($lease) {
    return $this->findOneByLease($lease, array('number' => 'DESC'));
  }

}