<?php

namespace App\Context\Infrastructure\Persistence\Doctrine\Repository;

use App\Context\Domain\Model\Group;
use App\Context\Domain\Model\Group\Translation as GroupTranslationEntity;
use App\Context\Domain\Repository\GroupRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class GroupRepository extends ServiceEntityRepository implements GroupRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    public function add(Group $group): void
    {
        $this->getEntityManager()->persist($group);
    }

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }

    public function getTranslationByIsoCode(string $isoCode)
    {
        return $this->_em->createQueryBuilder()
            ->select('ct')
            ->from(GroupTranslationEntity::class, 'ct')
            ->join('ct.language', 'l')
            ->where('l.isoCode = :isoCode')
            ->setParameter('isoCode', $isoCode)
            ->getQuery()
            ->getResult();
    }

    public function getByIdAndLanguageIso(string $id, string $languageIso)
    {
        return $this->_em->createQueryBuilder()
            ->select('gt')
            ->from(GroupTranslationEntity::class, 'gt')
            ->join('gt.language', 'l')
            ->join('gt.group', 'g')
            ->where('g.id = :id')
            ->andWhere('l.isoCode = :isoCode')
            ->setParameter('id', $id)
            ->setParameter('isoCode', $languageIso)
            ->getQuery()
            ->getResult()
        ;
    }
}
