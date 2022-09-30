<?php

namespace App\Context\Application\Service;

use App\Context\Domain\Model\Context;
use App\Context\Domain\Repository\ContextRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContextService
{
    private ContextRepositoryInterface $contextRepository;
    private NormalizerInterface $normalizer;

    public function __construct(
        ContextRepositoryInterface $contextRepository,
        NormalizerInterface $normalizer
    ) {
        $this->contextRepository = $contextRepository;
        $this->normalizer = $normalizer;
    }

    public function createContext(Uuid $id, int $name, Context $parent): Context
    {
        $context = Context::create($id, $name, $parent);
        $this->contextRepository->add($context);

        return $context;
    }
}
