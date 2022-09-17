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

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        if (null === $value) {
            return null;
        }

        return new Uuid($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!SymfonyUid::isValid($uuid = $value->getUuid())) {
            throw new InvalidUuidException();
        }

        return $uuid;
    }

    public function getName(): string
    {
        return self::APP_UUID;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
