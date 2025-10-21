<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NovoProdutoController extends AbstractController
{
    #[Route('/novo/produto', name: 'app_novo_produto')]
    public function index(): Response
    {
        return $this->render('novo_produto/index.html.twig', [
            'controller_name' => 'NovoProdutoController',
        ]);
    }
}
