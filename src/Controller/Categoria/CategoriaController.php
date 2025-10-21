<?php

namespace App\Controller\Categoria;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use Symfony\Component\HttpFoundation\Request;



final class CategoriaController extends AbstractController
{
    public function salvar(): Response
    {
        return $this->redirectToRoute('app_listar_categorias');
    }

    #[Route('/categoria/{id}', name: 'app_categoria_mostrar_editar', methods: ['GET', 'POST'])]
    public function mostrarEditar(
        int $id,
        Request $request,
        CategoriaRepository $categoriaRepository
    ): Response {
        $categoria = $categoriaRepository->find($id);

        if (!$categoria) {
            throw $this->createNotFoundException(
                'No categoria found for id ' . $id
            );
        }

        $categoria->setNome($request->get('nome'));
        $categoriaRepository->salvar($categoria);

        return $this->render('categoria/editar.html.twig');
    }

    #[Route('/categoria/{categoria}', name: 'app_categoria_mostrar_editar', methods: ['GET', 'POST'])]
    public function mostrarEditar2(
        Categoria $categoria,
        Request $request,
        CategoriaRepository $repo
    ): Response {
        $categoria->setNome($request->get('nome'));
        $repo->salvar($categoria);

        return $this->render('categoria/editar.html.twig');
    }

    #[Route('/categoria', name: 'app_categoria_salvar_editar', methods: ['POST'])]
    public function salvarEditar(): Response
    {
        // criar nova categoria
        return $this->redirectToRoute('app_listar_categorias');
    }
}