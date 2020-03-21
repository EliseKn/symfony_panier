<?php

namespace App\Controller;

use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * PAGE PANIER
     * @Route("/", name="panier")
     */

    public function index()
    {
        $pdo = $this->getDoctrine()->getManager();

        $panier = new Panier();
        $panier = $pdo->getRepository(Panier::class)->findAll();

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * AJOUT PANIER
     * @Route("/panier/add/{id}", name="panier_add")
     */
}