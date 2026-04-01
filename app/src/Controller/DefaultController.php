<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/default/{id}/{page}', name: 'app_default', requirements: ['id' => '\d+'], methods: ['GET'], defaults: ['id' => 1])]
    public function index(Request $request, int $id, int $page): Response
    {
        return $this->render('index.html.twig', [
            'id' => $id,
        ]);
    }
}
