<?php

namespace App\Domain\Quran;

use App\Domain\Repository\FormatRepositoryInterface;

class FormatService implements FormatServiceInterface
{
    private FormatRepositoryInterface $formatRepository;

    public function __construct(FormatRepositoryInterface $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function create(string $name)
    {
        // check name matches with predefined formats
        if (!array_key_exists($name, Format::getPreDefinedFormat())) {
            throw new \Exception(sprintf('Format: %s is not valid', $name));
        }

        // check name already exists in db
        $isExist = $this->formatRepository->getOneByName($name);
        if ($isExist) {
            throw new \Exception(sprintf('Format: %s already exists.', $name));
        }

        $format = (new Format())
            ->setName($name)
        ;
        $this->formatRepository->add($format);

        return $format;
    }
}
