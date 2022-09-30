<?php

namespace App\Context\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContextController extends AbstractController
{
    public function details(): Response
    {
        return $this->render('@quran/chapter/details.html.twig');
    }
}
