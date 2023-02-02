<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\ContactModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        //appel au formulaire

        $entite_contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $entite_contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { //si les infos sont valide et qu'on clique sur le boutton "envoyer"

            $entityManager->persist($entite_contact);
            $entityManager->flush(); // ajouter les données dans la base !

            $this->addFlash('notice', 'Message Envoyé!');

            return $this->redirectToRoute('index');
        }



        $titre = "Formulaire de contact";


        return $this->render('contact/index.html.twig', [
            'titre' => $titre,
            'form' => $form->createView()
        ]);
    }
}