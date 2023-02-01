<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
     * Summary of allCategory
     * @Route("/categories",name="indexCategory")
     * @Route("/categories/{id}",name="indexCategory2")
     */
    public function indexCategory(int $id = 1)
    {
        $categorie = $this->categoryRepository->getAllCategory();

        $produit_par_category = $this->categoryRepository->getProductsByCategory($id);
        $titre = "Categories";
        dump($categorie);
        dump($produit_par_category);
        return $this->render('default/category.html.twig', ['titre' => $titre, 'categories' => $categorie, 'produit_par_category' => $produit_par_category]);
    }


}