<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Quran\Language;
use App\Domain\Repository\LanguageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LanguageRepository extends ServiceEntityRepository implements LanguageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }

    public function getById(int $id)
    {
        return $this->find($id);
    }

    public function getOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
