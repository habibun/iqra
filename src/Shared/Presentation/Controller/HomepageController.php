<?php

namespace App\Shared\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    public function indexNoLocale(): RedirectResponse
    {
        return $this->redirectToRoute('homepage', ['_locale' => 'en']);
    }

    public function index(): Response
    {
        return $this->render('@shared/homepage/index.html.twig');
    }
}
