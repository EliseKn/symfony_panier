<?php

namespace App\Controller;

use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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

    public function delete(Panier $panier=null, TranslatorInterface $translator){
        if($panier != null){
            $pdo = $this->getDoctrine()->getManager();
            $pdo->remove($panier);
            $pdo->flush();

            $this->addFlash("success", $translator->trans('Flash.panier.erreur'));
        }
        else{
            $this->addFlash("danger", $translator->trans('Flash.panier.suppr'));
        }
        return $this->redirectToRoute('panier');
    }
}