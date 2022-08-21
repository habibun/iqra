<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ChapterService
{
    private ChapterRepositoryInterface $chapterRepository;
    private ContainerBagInterface $containerBag;
    private SerializerInterface $serializer;
    private NormalizerInterface $normalizer;

    public function __construct(
        ChapterRepositoryInterface $chapterRepository,
        ContainerBagInterface $containerBag,
        SerializerInterface $serializer,
        NormalizerInterface $normalizer
    ) {
        $this->chapterRepository = $chapterRepository;
        $this->containerBag = $containerBag;
        $this->serializer = $serializer;
        $this->normalizer = $normalizer;
    }

    public function createChapter(
        Uuid $id,
        int $chapterNumber,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        Info $info
    ): Chapter {
        $chapter = Chapter::create(
            $id,
            $chapterNumber,
            $revelationPlace,
            $revelationOrder,
            $bismillahPre,
            $nameSimple,
            $nameComplex,
            $nameArabic,
            $versesCount,
            $pages,
            $info
        );
        $this->chapterRepository->add($chapter);

        return $chapter;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->chapterRepository->getByNameSimple($nameSimple);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->chapterRepository->nextIdentity();
    }

    public function getVerseByVerseNumber(int $verseNumber)
    {
        return $this->chapterRepository->getVerseByVerseNumber($verseNumber);
    }

    public function getRandomVerse()
    {
        $defaultContext = [
            'groups' => 'verse_details',
        ];

        $verse = $this->getVerseByVerseNumber(rand(1, 6666));
        $verse = $this->normalizer->normalize($verse, 'json', $defaultContext);

        return $verse;
    }
}
