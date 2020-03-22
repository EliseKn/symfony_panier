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
        $panier = $pdo->getRepository(Panier::class)->findAll();

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * PAGE SUPPRESSION 
     * @Route("/panier/delete/{id}", name="panier_delete")
     */

    public function delete(Panier $panier=null){
        if($panier != null){
            $pdo = $this->getDoctrine()->getManager();
            $pdo->remove($panier);
            $pdo->flush();

            $this->addFlash("success", "Produit supprimé");
        }
        else{
            $this->addFlash("danger", "Erreur");
        }
        return $this->redirectToRoute('panier');
    }
}