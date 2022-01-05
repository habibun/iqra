<?php

namespace App\Miracle\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@miracle/homepage/index.html.twig');
    }
}
