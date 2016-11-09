<?php

namespace CG\SocialBundle\Repository;

use Doctrine\ORM\EntityRepository;
//use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TopicRepository extends EntityRepository
{

    public function getPaginatedTopics(int $page = 0, int $nbPerPage = 10)
    {
        $qb = $this->getTopics();
        $query = $qb
                ->getQuery()
                ->setFirstResult(($page - 1) * $nbPerPage)
                ->setMaxResults($nbPerPage);
        return new Paginator($query, true);
    }

    public function getPaginatedUserTopics(\CG\UserBundle\Entity\User $user, int $page = 0, int $nbPerPage = 10)
    {
        $qb = $this->getTopics();
        $qb
                ->andWhere('t.user = :user')
                ->setParameter('user', $user);
        $query = $qb->getQuery()
                ->setFirstResult(($page - 1) * $nbPerPage)
                ->setMaxResults($nbPerPage);
        return new Paginator($query, true);
    }

    public function getTopics()
    {
        $qb = $this
                ->createQueryBuilder('t')
                ->where('t.deleted  = 0')
                ->leftJoin('t.user', 'u')
                ->addSelect('u')
                ->leftJoin('t.responses', 'r')
                ->addSelect('r')
                ->orderBy('t.datetimeCreate', 'DESC');
        return $qb;
    }

}
