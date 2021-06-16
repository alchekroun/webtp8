<?php


namespace App\Controller;


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

}