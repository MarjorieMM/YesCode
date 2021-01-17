<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    setFullName()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function selectUserWithFullname()
    {
        return $this->createQueryBuilder('u')
            ->select("u.id, u.firstname, u.lastname, CONCAT(u.firstname, ' ', u.lastname) AS fullname, u.email, u.hash, u.avatar, u.presentation, u.slug")
            ->getQuery()
            ->getResult()
        ;
    }
}