<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class catalogue extends AbstractController
{

    /**
     * @return Response
     * @Route("/catalogue", name="catalogue")
     */
    public function catalogue(): Response
    {
        // TODO gérer la connexion POST

        return $this->render('catalogue.html.twig');
    }


}