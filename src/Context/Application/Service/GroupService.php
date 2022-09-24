<?php

namespace App\Context\Application\Service;

use App\Context\Domain\Model\Group;
use App\Context\Domain\Repository\GroupRepositoryInterface;
use App\Quran\Domain\Model\Translator;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GroupService
{
    private GroupRepositoryInterface $groupRepository;
    private NormalizerInterface $normalizer;

    public function __construct(
        GroupRepositoryInterface $groupRepository,
        NormalizerInterface $normalizer
    ) {
        $this->groupRepository = $groupRepository;
        $this->normalizer = $normalizer;
    }

    public function createGroup(Uuid $id, int $name, Group $group): Group
    {
        $group = Group::create($id, $name, $group);
        $this->groupRepository->add($group);

        return $group;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->groupRepository->getByNameSimple($nameSimple);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->groupRepository->nextIdentity();
    }

    public function getVerseByVerseNumber(int $verseNumber)
    {
        return $this->groupRepository->getVerseByVerseNumber($verseNumber);
    }

    public function getList(string $locale)
    {
        $group = $this->groupRepository
            ->getTranslationByIsoCode($locale);
//        dd($group);

//        dd(Uuid::fromString(\Symfony\Component\Uid\Uuid::v4()));
//        dd($this->normalizer->normalize($verse, 'json', ['groups' => 'group_list']));

        return $this->normalizer->normalize($group, 'json', ['groups' => 'group_list']);
    }

    public function getByIdAndLanguageIso(string $id, string $locale)
    {
        $group = $this->groupRepository->getByIdAndLanguageIso($id, $locale);

        return $this->normalizer->normalize($group, 'json', ['groups' => 'group_details']);
    }
}
