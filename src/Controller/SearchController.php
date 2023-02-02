<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\BarreRechercheType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SearchController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    #[Route('/search', name: 'search')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $titre = "Rechercher un produit";

        //appel au formulaire
        $produit = new Product();

        $form = $this->createForm(BarreRechercheType::class, $produit);

        $form->handleRequest($request);

        $resultats = '';

        if ($form->isSubmitted() && $form->isValid()) { //si les infos sont valide et qu'on clique sur le boutton "envoyer"

            $saisie = $form['name']->getData(); //recuperer la valeur saisie dans le formulaire

            $resultats = $this->productRepository->search($saisie);

        }



        return $this->render('search/index.html.twig', [
            'titre' => $titre,
            'form' => $form->createView(),
            'resultats' => $resultats
        ]);
    }
}