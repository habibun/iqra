<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Quran\Type;
use App\Domain\Repository\TypeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TypeRepository extends ServiceEntityRepository implements TypeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function getById(int $id)
    {
        return $this->find($id);
    }

    public function getOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function add(Type $format)
    {
        $this->getEntityManager()->persist($format);
        $this->getEntityManager()->flush($format);
    }
}
