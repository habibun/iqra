<?php

namespace App\Domain\Quran\Chapter;

use App\Domain\Repository\RevelationTypeRepositoryInterface;

class RevelationTypeService implements RevelationTypeServiceInterface
{
    private RevelationTypeRepositoryInterface $revelationTypeRepository;

    public function __construct(RevelationTypeRepositoryInterface $revelationTypeRepository)
    {
        $this->revelationTypeRepository = $revelationTypeRepository;
    }

    public function create(string $name)
    {
        // check name matches with predefined types
        if (!array_key_exists($name, RevelationType::getPreDefinedRevelationType())) {
            throw new \Exception(sprintf('RevelationType: %s is not valid', $name));
        }

        // check name already exists in db
        $isExist = $this->revelationTypeRepository->getOneByName($name);
        if ($isExist) {
            return $isExist;
        }

        $revelationType = (new RevelationType())
            ->setName($name)
        ;
        $this->revelationTypeRepository->add($revelationType);

        return $revelationType;
    }
}
