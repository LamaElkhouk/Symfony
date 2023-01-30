<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    private array $tab = [
        'item1' => ["nom" => "item1", "prix" => 10, "image" => "images/robe_grise.jpg"],
        'item2' => ["nom" => "item2", "prix" => 11, "image" => "images/robe_noire.jpg"],
        'item3' => ["nom" => "item3", "prix" => 9, "image" => "images/robe_rose.jpg"],
        'item4' => ["nom" => "item4", "prix" => 12, "image" => "images/robe_verte.jpg"],
    ];


    /**
     * @Route("/",name="index")
     * @return void
     */
    public function index()
    {
        /*var_dump("ça fonctionne");
        die();*/

        $titre = "titre principal";


        /*$tab =[
            {'id':1;'nom':'item'}
        ]*/
        // $nb = count($this->tab);
        return $this->render('default/index.html.twig', ['titre' => $titre, 'tab' => $this->tab,]);
    }
    /**
     * Undocumented function
     *
     * @param [type] $nom
     * @return void
     * @Route("/article/{nom}",name="detail")
     */
    public function detail($nom)
    {
        $titre = "detail d'un produit : ";

        // tester si le produit existe dans la liste
        if (array_key_exists($nom, $this->tab)) {
            return $this->render('default/detail.html.twig', ['titre' => $titre, 'nom' => $nom]);
        }
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
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
     * Undocumented function
     *
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