<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/",name="index")
     * @return void
     */
    public function index()
    {
        var_dump("ça fonctionne");
        die();
    }
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