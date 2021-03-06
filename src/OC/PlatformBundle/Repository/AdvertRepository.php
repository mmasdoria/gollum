<?php

declare(strict_types=1);

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class AdvertRepository
 * @package OC\PlatformBundle\Repository
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function myFindAll(): array

    {
        $queryBuilder = $this->createQueryBuilder('a');

        $query = $queryBuilder->getQuery();

        $results = $query->getResult();

        return $results;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function myFindOne(int $id): array

    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string    $author
     * @param \DateTime $year
     *
     * @return array
     */
    public function findByAuthorAndDate(string $author, \DateTime $year): array
    {
        $qb = $this->createQueryBuilder('a')
            ->where('a.author = :author')
            ->andWhere('a.date < :year')
            ->setParameters([
                'author' => $author,
                'year'   => $year
            ])
            ->orderBy('a.date', 'DESC')
            ->getQuery();

        return $qb->getResult();
    }

    /**
     * @param QueryBuilder $qb
     */
    public function whereCurrentYear(QueryBuilder $qb)
    {

        $qb
            ->andWhere('a.date BETWEEN :start AND :end')
            ->setParameter('start', new \Datetime(date('Y') . '-01-01'))
            ->setParameter('end', new \Datetime(date('Y') . '-12-31'));
    }

    /**
     * @return array
     */
    public function myFind(): array

    {

        $qb = $this->createQueryBuilder('a')
            ->where('a.author = :author')
            ->setParameter('author', 'Marine');

        $this->whereCurrentYear($qb);

        $qb->orderBy('a.date', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $categoryNames
     *
     * @return array
     */

    public function getAdvertWithCategories(array $categoryNames): array
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->addSelect('c');

        $qb
            ->where($qb->expr()->in('c.name', $categoryNames));

        return $qb
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $page
     * @param $nbPerPage
     *
     * @return Paginator
     */
    public function getAdverts($page, $nbPerPage): Paginator
    {
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.image', 'i')
            ->addSelect('i')
            ->leftJoin('a.categories', 'c')
            ->addSelect('c')
            ->orderBy('a.date', 'DESC')
            ->getQuery();

        $query
            ->setFirstResult(($page - 1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }

    public function deleteAdvertByDaysPassed($nbDays)
    {
        $date = new \DateTime();
        $date->modify('-' . $nbDays . 'days');

        $qb = $this->createQueryBuilder('a')
            ->delete('OCPlatformBundle:Advert', 'advert')
            ->where('a.updatedAt < : date')
            ->andWhere('a.nbApplications = nbApp')
            ->setParameter('date', $date)
            ->setParameter('nbApp', 0);

        return $qb
            ->getQuery()
            ->getResult();

    }
}
