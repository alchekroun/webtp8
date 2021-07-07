<?php

namespace App\Controller;

use App\Repository\articleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RechercheRepository;

class RechercheController extends AbstractController
{
    /**
     * @Route("/rechercheFiltre", name="rechercheFiltre")
     * @param Request $request
     * @return Response
     */
    public function rechercheFiltre(Request $request): Response
    {
        $livres = new RechercheRepository();
        $test1 = $livres->searchFilter('auteur', 'e');
        $resultSearchFilter = json_decode($test1);
        $res = $resultSearchFilter->{'hits'}->{'hits'};
        //print_r($res[0]->{'_source'});
        return $this->render('home/recherche.html.twig', [
            "livres" => $res
        ]);
    }
    /**
     * @Route("/rechercheAll", name="rechercheAll")
     * @param Request $request
     * @return Response
     */
    public function rechercheAll(Request $request): Response
    {
        if($request->isMethod('post')){
            $posts = $request->request->all();
            $post = $request->request->get("searchCatalogue");
            $recherche = new RechercheRepository();
            $result= $recherche->searchInAll($post);
            $resultSearchFilter = json_decode($result);
            $res = $resultSearchFilter->{'hits'}->{'hits'};
            $livres = new articleRepository();
            // print_r($res); //$res[0]->{'_source'}
            $arrayTest = [];
            for( $i= 0 ; $i < count($res) ; $i++ )
            {
                $livre = $livres->getItemById($res[$i]->{'_source'}->{'id'});
                array_push($arrayTest, $livre);
            }
            return $this->render('home/recherche.html.twig', [
                "listLivre" => $arrayTest
            ]);
        }
        return $this->render('home/index.html.twig');
    }
}