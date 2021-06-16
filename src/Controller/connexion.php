<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class connexion extends AbstractController
{

    /**
     * @return Response
     * @Route("/connexion", name="connexion")
     */
    public function connexion(): Response
    {
        // TODO gérer la connexion POST

        return $this->render('inscription.html.twig');
    }

    /**
     * @return Response
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(): Response
    {
        // TODO Déconnecter l'utilisateur dans la session
        // TODO une redirection à l'accueil

        return $this->redirectToRoute("accueil");
    }

    /**
     * @return Response
     * @Route("/inscription", name="inscription")
     */
    public function inscription(): Response
    {
        // TODO gérer l'inscription POST

        return $this->render('inscription.html.twig');
    }
}