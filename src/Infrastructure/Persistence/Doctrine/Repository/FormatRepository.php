<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Format;
use App\Domain\Repository\FormatRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FormatRepository extends ServiceEntityRepository implements FormatRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Format::class);
    }

    public function getById(int $id)
    {
        return $this->find($id);
    }

    public function getOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function add(Format $format)
    {
        $this->getEntityManager()->persist($format);
        $this->getEntityManager()->flush($format);
    }
}
