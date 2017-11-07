<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class RentRepository
 * @package AppBundle\Entity\Repository
 */
class RentMotoRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        return $this->findBy([], ['id' => 'ASC']);
    }


    /**
     * @return array
     */
    public function findAvailable()
    {
        return $this->findBy(['available' => true]);
    }

    /**
     * Jointure gauche SQL avec l'id vehicule sélectionné de la table "vehicle" et où une condition est une pré-réservation active de "rent".
     */

    public function getRentActived($parameter)
    {
        $query = $this->createQueryBuilder('e')
            ->leftJoin('e.vehicle', 'v')
            ->where('v.id = :parameter')
            ->andWhere('e.actived=true')
            ->setParameter('parameter', $parameter)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Jointure gauche SQL avec l'id vehicule sélectionné de la table "vehicle" et où une condition est que la date doit être > à celle du jour
     */

    public function getDateDifferent($parameter)
    {
        $query = $this->createQueryBuilder('d')
            ->leftJoin('d.vehicle', 'v')
            ->where('v.id = :parameter')
            ->andWhere('d.date > :date')
            ->setParameter('parameter', $parameter)
            ->setParameter('date', new \DateTime(date("d-m-Y", time() )))
            ->getQuery();

        return $query->getResult();
    }
}