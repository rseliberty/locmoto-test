<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class VehicleRepository
 * @package AppBundle\Entity\Repository
 */
class VehicleRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function findMoto()
    {
        //pr n'afficher que les motos
        return $this->findBy(['type' => 'MOTORBIKE'], ['id' => 'ASC']);

    }

    /**
     * @return array
     */
    public function findAvailable()
    {
        return $this->findBy(['available' => true]);
    }
    /**
     * @return array
     */
    public function findAllSuzuki()
    {
        return $this->findBy(['brand' => 'Suzuki']);
    }

    /**
     * @return array
     */
    public function findAllmodelsDispo()
    {
        return $this->findBy(['comment' => 'Disponible'],['id' => 'DESC'], 3);
    }

}