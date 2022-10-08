<?php

namespace App\Sign\Infrastructure\Persistence\Doctrine\Repository;

use App\Sign\Domain\Model\Sign;
use App\Sign\Domain\Model\Sign\Translation as SignTranslationEntity;
use App\Sign\Domain\Repository\SignRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SignRepository extends ServiceEntityRepository implements SignRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sign::class);
    }

    public function add(Sign $sign): void
    {
        $this->getEntityManager()->persist($sign);
    }

    public function getTranslationByIsoCode(string $isoCode)
    {
        return $this->_em->createQueryBuilder()
            ->select('st')
            ->from(SignTranslationEntity::class, 'st')
            ->join('st.language', 'l')
            ->where('l.isoCode = :isoCode')
            ->setParameter('isoCode', $isoCode)
            ->getQuery()
            ->getResult();
    }

    public function getByIdAndLanguageIso(string $id, string $languageIso)
    {
        return $this->_em->createQueryBuilder()
            ->select('st')
            ->from(SignTranslationEntity::class, 'st')
            ->join('st.language', 'l')
            ->join('st.sign', 's')
            ->where('s.id = :id')
            ->andWhere('l.isoCode = :isoCode')
            ->setParameter('id', $id)
            ->setParameter('isoCode', $languageIso)
            ->getQuery()
            ->getResult()
        ;
    }
}
