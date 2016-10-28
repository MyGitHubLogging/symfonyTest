<?php

namespace CG\SocialBundle\Repository;

use Doctrine\ORM\EntityRepository;
//use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ResponseRepository extends EntityRepository {

    public function getResponsesByUser(CG\UserBundle\Entity\User $user, int $page = 1, int $nbPerPage = 10) {
        $qb = $this->createQueryBuilder('r')
                ->where('r.user = :user')
                ->setParameter('user', $user)
                ->orderBy('r.datetimeCreate', 'DESC');
        $query = $qb->getQuery()
                ->setFirstResult(($page - 1) * $nbPerPage)
                ->setMaxResults($nbPerPage);
        return new Paginator($query, true);
    }

    public function getResponses(CG\UserBundle\Entity\User $user, int $page = 1, int $nbPerPage = 10) {
        $qb = $this->createQueryBuilder('r')
                ->orderBy('r.datetimeCreate', 'DESC');
        $query = $qb->getQuery()
                ->setFirstResult(($page - 1) * $nbPerPage)
                ->setMaxResults($nbPerPage);
        return new Paginator($query, true);
    }

}
