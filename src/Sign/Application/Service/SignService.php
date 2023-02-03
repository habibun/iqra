<?php

namespace App\Sign\Application\Service;

use App\Shared\Application\Service\BaseService;
use App\Sign\Domain\Model\Sign;
use App\Sign\Domain\Repository\SignRepositoryInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SignService extends BaseService
{
    private readonly SignRepositoryInterface $signRepository;
    private readonly NormalizerInterface $normalizer;

    public function __construct(
        SignRepositoryInterface $signRepository,
        NormalizerInterface $normalizer
    ) {
        $this->signRepository = $signRepository;
        $this->normalizer = $normalizer;
    }

    public function createSign(string $image): Sign
    {
        $sign = Sign::create($this->getNextIdentity(), $image);
        $this->signRepository->add($sign);

        return $sign;
    }

    public function getList(string $locale)
    {
        $sign = $this->signRepository
            ->getTranslationByIsoCode($locale);

        return $this->normalizer->normalize($sign, 'json', ['groups' => 'sign_list']);
    }

    public function getByIdAndLanguageIso(string $id, string $locale)
    {
        $sign = $this->signRepository->getByIdAndLanguageIso($id, $locale);

        return $this->normalizer->normalize($sign, 'json', ['groups' => 'sign_details']);
    }
}
