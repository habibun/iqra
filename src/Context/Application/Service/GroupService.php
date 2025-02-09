<?php

namespace App\Context\Application\Service;

use App\Context\Domain\Model\Group;
use App\Context\Domain\Repository\GroupRepositoryInterface;
use App\Shared\Application\Service\BaseService;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GroupService extends BaseService
{
    private readonly GroupRepositoryInterface $groupRepository;
    private readonly NormalizerInterface $normalizer;

    public function __construct(
        GroupRepositoryInterface $groupRepository,
        NormalizerInterface $normalizer
    ) {
        $this->groupRepository = $groupRepository;
        $this->normalizer = $normalizer;
    }

    public function createGroup(): Group
    {
        $group = Group::create($this->getNextIdentity());
        $this->groupRepository->add($group);

        return $group;
    }

    public function getList(string $locale)
    {
        $group = $this->groupRepository
            ->getTranslationByIsoCode($locale);

        return $this->normalizer->normalize($group, 'json', ['groups' => 'group_list']);
    }

    public function getByIdAndLanguageIso(string $id, string $locale)
    {
        $group = $this->groupRepository->getByIdAndLanguageIso($id, $locale);

        return $this->normalizer->normalize($group, 'json', ['groups' => 'group_details']);
    }
}
