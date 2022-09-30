<?php

namespace App\Context\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@context/index/index.html.twig');
    }
}
