<?php


namespace App\Controller;


use App\Repository\panierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class panier
 * @package App\Controller
 * @Route("/panier")
 */
class panier extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="panier")
     */
    public function index(): Response
    {

        return $this->render('panier.html.twig');
    }

    /**
     * @return Response
     * @Route("/ajouter/{id}", name="panier_ajouter", requirements={"id"="\d+"})
     */
    public function ajouter(int $id): Response
    {
        $panierRepo = new panierRepository();

        $panierRepo->ajouterItem($id);

        return $this->render('panier.html.twig', [
            "panier" => $panierRepo->getPanier()
        ]);
    }

    /**
     * @return Response
     * @Route("/retirer/{id}", name="panier_retirer", requirements={"id"="\d+"})
     */
    public function retirer(int $id): Response
    {
        $panierRepo = new panierRepository();

        $panierRepo->ajouterItem($id);

        return $this->render('panier.html.twig', [
            "panier" => $panierRepo->getPanier()
        ]);
    }

}