<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Model\Translation;
use App\Domain\Repository\TranslationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TranslationRepository extends ServiceEntityRepository implements TranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Translation::class);
    }

    public function add(Translation $translation)
    {
        $this->getEntityManager()->persist($translation);
        $this->getEntityManager()->flush($translation);
    }

    public function getBySlug(string $slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}
