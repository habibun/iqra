<?php

namespace App\Quran\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class QuranController extends AbstractController
{
    public function list(): Response
    {
        return $this->render('@quran/quran/index.html.twig', [
            'controller_name' => 'QuranController',
        ]);
    }
}
