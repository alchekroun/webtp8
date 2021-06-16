<?php


namespace App\Controller;


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
        $q = [1, 2, 3];

        return $this->render('accueil.html.twig', [
            'x' => 2,
            'request' => $q,
        ]);
    }

}