<?php

namespace App\Domain\Quran;

use App\Domain\Repository\TypeRepositoryInterface;

class TypeService implements TypeServiceInterface
{
    private TypeRepositoryInterface $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function create(string $name)
    {
        // check name matches with predefined types
        if (!array_key_exists($name, Type::getPreDefinedType())) {
            throw new \Exception(sprintf('Type: %s is not valid', $name));
        }

        // check name already exists in db
        $isExist = $this->typeRepository->getOneByName($name);
        if ($isExist) {
            throw new \Exception(sprintf('Type: %s already exists.', $name));
        }

        $type = (new Type())
            ->setName($name)
        ;
        $this->typeRepository->add($type);

        return $type;
    }
}
