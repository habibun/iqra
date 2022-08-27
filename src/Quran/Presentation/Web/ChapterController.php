<?php

namespace App\Quran\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ChapterController extends AbstractController
{
    public function details(): Response
    {
        return $this->render('@quran/chapter/details.html.twig');
    }
}
