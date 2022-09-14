<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine\Dbal;

use App\Shared\Domain\Exception\InvalidUuidException;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Uid\Uuid as SymfonyUid;

class UuidType extends StringType
{
    public const APP_UUID = 'app_uuid';

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return new Uuid($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!SymfonyUid::isValid($uuid = $value->getUuid())) {
            throw new InvalidUuidException();
        }

        return $uuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return self::APP_UUID;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
