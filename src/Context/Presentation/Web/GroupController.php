<?php

namespace App\Context\Presentation\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends AbstractController
{
    public function details(): Response
    {
        return $this->render('@context/group/details.html.twig');
    }
}
