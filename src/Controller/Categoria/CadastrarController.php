<?php

namespace App\Controller\Categoria;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CadastrarController extends AbstractController
{
    public function __construct(
        private CategoriaRepository $categoriaRepository,
    ) {}

    #[Route('categorias/cadastrar', name: 'app_cadastrar_categoria', methods: 'GET')]
    public function show(): Response
    {
        return $this->render('app/categoria/cadastrar/index.html.twig');
    }

    #[Route('categorias/cadastrar', name: 'cadastrar_categoria_salvar', methods: 'POST')]
    public function salvar(Request $request): Response
    {
        $nomeCategoria = $request->request->get('nome');
        if (strlen($nomeCategoria) > 50) {
            $this->addFlash('danger', "Nome deve ter no máximo 50 caracteres!");
            return $this->redirectToRoute('app_cadastrar_categoria');

            $categoriaExistente = $this->categoriaRepository->findBy(['nome'=>$nomeCategoria]);
            if ($categoriaExistente) {
                $this->addFlash('danger', "Categoria com nome \"{$nomeCategoria}\" já existe!");

                return $this->redirectToRoute('app_cadastrar_categoria');
            }
        }

        $categoria = new Categoria();
        $categoria->setNome($nomeCategoria);

        $this->categoriaRepository->salvar($categoria);

         return $this->redirectToRoute('app_listar_categorias');

    }
}

