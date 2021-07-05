<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class commande
 * @package App\Controller
 * @Route("/commande")
 */
class commande extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="commande")
     */
    public function index(): Response
    {

        return $this->render('commandes/index.html.twig');
    }

    /**
     * @return Response
     * @Route("/traitement", name="traitement_commande")
     */
    public function traitementCommande(): Response
    {
        // TODO Logique métier BDD appeler fonction dans le repository

        return $this->redirectToRoute('commande');
    }

}