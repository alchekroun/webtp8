<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFOundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class accueil
 */
class accueil extends AbstractController
{

    /**
     * @return Response
     * @Route("/")
     */
    public function index(): Response
    {
        $q = [1, 2, 3];

        return $this->render('accueil.html.twig', [
            'x' => 2,
            'request' => $q,
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     * @Route("/accueil")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
          '<html><body> lucky ' . $number . '</body></html>'
        );
    }

}