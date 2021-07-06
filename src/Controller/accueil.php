<?php


namespace App\Controller;


use App\Repository\articleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class accueil
 */
class accueil extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $articleRepo = new articleRepository();

        return $this->render('home/index.html.twig', [
            "livres" => $articleRepo->getAllItemAvailable()
        ]);
    }

}