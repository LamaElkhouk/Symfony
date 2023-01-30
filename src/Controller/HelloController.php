<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController
{
    /**
     * @Route("/hello/{nom?world}",name="AfficheHello")
     */

    public function AfficheHello(Request $request, $nom)
    {
        return new Response("Hello $nom");
    }
}