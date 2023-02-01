<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Repository\ProductRepository;

class TestController extends AbstractController
{

    public function __construct(private ProductRepository $productRepository)
    {
    }


    /**
     * @Route("/",name="index")
     * @return void
     */
    public function index()
    {
        $titre = "Accueil";
        $randomProducts = $this->productRepository->getRandomProduct()->getResult();
        //dd($randomProducts);  //var_dump() and die()
        return $this->render('default/index.html.twig', ['titre' => $titre, 'tab' => $randomProducts]);
    }

    /**
     * @Route("/products", name="allProductsV2")
     * @Route("/products/page/{page}", name="allProducts")
     */
    public function allProducts(int $page = 1)
    {
        $titre = "Tout les produits";
        //$Products = $this->productRepository->findAll();

        $nbProduct = $this->productRepository->nbProduct()->getSingleScalarResult();

        $limit = 4;
        $pagination = $this->productRepository->pagination($page, $limit);
        dump($pagination);

        return $this->render('default/produits.html.twig', ['titre' => $titre, 'tab' => $pagination, 'nbProduct' => $nbProduct, 'page' => $page, 'pagination' => $pagination]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $nom
     * @return void
     * @Route("/produit/{name}",name="detail")
     */
    public function detail($name)
    {
        $titre = "Détail d'un produit : ";

        $item = $this->productRepository->findBy(['name' => $name]);

        //dd($item);

        return $this->render('default/detail.html.twig', ['titre' => $titre, 'item' => $item]);
    }
    /**
     * @param Request $request
     * @return void
     * @Route("/test",name="test")
     */
    public function test(Request $request)
    {
        // $request = Request::createFromGlobals();

        //solution 1 
        /**
         * $age = 0;
         *if (!empty($_GET['age'])) {
         *    $age = $_GET['age'];
         *}
         */
        //solution 2 plus pratique

        $age = $request->query->get('age', 0);

        // query represente les parametres qui sont passé dans l'URL en $_GET
        // request represent les parametres qui sont passé en $_POS

        return new Response("vous avez $age ans");
    }

    /**
     * @param Request $request
     * @param [type] $age
     * @return void
     * @Route("/test2/{age<\d+>?0}",name="test2")
     */
    public function test2(Request $request, $age)
    {
        dump($request); // les informations sont stocké dans attributes
        //$age = $request->query->get('age', 0);

        //$age = $request->attributes->get('age');  SINON appeler $age dans les parametres de la fonction!
        return new Response("vous avez $age ans");
    }
}