<?php

namespace App\Controller\Categoria;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoriaRepository;

class ListarController extends AbstractController
{
    public function __construct(
        private CategoriaRepository $categoriaRepository,
    ) { }

    #[Route('/categorias', name: 'app_listar_categorias', methods: 'GET')]
    public function show(): Response
    {
        return $this->render('app/categoria/listar/index.html.twig', [
            'categorias' => $this->categoriaRepository->findAll(),
        ]);
    }
}
