<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Repository;


/**
 * Class ApplicationRepository
 *
 * @package OC\PlatformBundle\Repository
 */
class ApplicationRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $limit
     *
     * @return array
     */
    public function getApplicationsWithAdvert($limit): array
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->innerJoin('a.advert', 'advert')
            ->addSelect('advert')
            ->addOrderBy('advert.date', 'DESC')
            ->setMaxResults($limit);


        return $qb
            ->getQuery()
            ->getResult();
    }
}
