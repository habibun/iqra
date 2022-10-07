<?php

namespace App\Sign\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SignController extends AbstractController
{
    public function details(): Response
    {
        return $this->render('@sign/sign/details.html.twig');
    }
}
