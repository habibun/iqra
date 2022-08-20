<?php

namespace App\Quran\Presentation\Api;

use App\Quran\Application\Service\ChapterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class VerseController extends AbstractController
{
    private ChapterService $chapterService;
    private NormalizerInterface $normalizer;

    public function __construct(ChapterService $chapterService, NormalizerInterface $normalizer)
    {
        $this->chapterService = $chapterService;
        $this->normalizer = $normalizer;
    }

    public function random(): Response
    {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];

        $verse = $this->chapterService->getRandomVerse();
//        dd($verse);
        $json = $this->normalizer->normalize($verse, 'json', $defaultContext);
//        dd($json);


        return new JsonResponse($json);
    }
}
