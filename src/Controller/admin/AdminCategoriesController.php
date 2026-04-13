<?php

namespace App\Controller\admin;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminCategoriesController
 *
 * @author Antho
 */
class AdminCategoriesController extends AbstractController
{
    /**
     * @var CategorieRepository
     */
    private $repository;

    /**
     * @param CategorieRepository $repository
     */
    public function __construct(CategorieRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/admin/categories', name: 'admin.categories')]
    public function index(): Response
    {
        $categories = $this->repository->findAll();

        return $this->render('admin/admin.categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/categorie/suppr/{id}', name: 'admin.categorie.suppr')]
    public function suppr(int $id): Response
    {
        $categorie = $this->repository->find($id);
        $this->repository->remove($categorie);

        return $this->redirectToRoute('admin.categories');
    }

    #[Route('/admin/categorie/ajout', name: 'admin.categorie.ajout')]
    public function ajout(Request $request): Response
    {
        $nomCategorie = $request->get('nom');

        if (!$nomCategorie || trim($nomCategorie) === '') {
            return $this->redirectToRoute('admin.categories');
        }

        $categorieExistante = $this->repository->findOneBy(['name' => $nomCategorie]);

        if ($categorieExistante) {
            return $this->redirectToRoute('admin.categories');
        }

        $categorie = new Categorie();
        $categorie->setName($nomCategorie);
        $this->repository->add($categorie);

        return $this->redirectToRoute('admin.categories');
    }
}
