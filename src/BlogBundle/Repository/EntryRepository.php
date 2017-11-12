<?php
/**
 *
 * User: enrique
 * Date: 2/08/17
 * Time: 11:33
 */
namespace BlogBundle\Repository;

use BlogBundle\Entity\Entry;
use BlogBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EntryRepository extends EntityRepository
{
    /**
     * Encuentra una cantidad fija de entradas de las más nuevas a las más viejas
     * @param int $limit
     * @param string $status
     * @return array
     */
    public function findRecentEntries($limit = 5, $status = 'public') {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT e, u, c
            FROM BlogBundle:Entry e
            JOIN e.user u
            JOIN e.category c
            WHERE e.status = :status
            ORDER BY e.createAt DESC'
        );
        $query->setParameter('status', $status);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function findOneBySlug($slug, $status = 'public')
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT e, u, c, m, t
            FROM BlogBundle:Entry e
            JOIN e.user u
            JOIN e.category c
            JOIN e.comments m
            JOIN e.tags t
            WHERE e.status = :status 
            AND e.slug = :slug
            ORDER BY e.createAt DESC'
        );
        $query->setParameters(array(
            'status' => $status,
            'slug' => $slug,
        ));

        return $query->getOneOrNullResult();
    }
}