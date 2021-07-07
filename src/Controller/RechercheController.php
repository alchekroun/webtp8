<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\rechercheRepository;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="rechercheFiltre")
     * @param Request $request
     * @return Response
     */
    public function rechercheFiltre(Request $request): Response
    {
        $livres = new rechercheRepository();
        $test1 = $livres->searchFilter('auteur', 'e');
        $resultSearchFilter = json_decode($test1);
        $res = $resultSearchFilter->{'hits'}->{'hits'};
        //print_r($res[0]->{'_source'});
        return $this->render('recherche.html.twig', [
            "livres" => $res
        ]);
    }
    /**
     * @return Response
     * @Route("/recherche", name="rechercheAll")
     */
    public function rechercheAll(): Response
    {
        $livres = new rechercheRepository();
        $test = $livres->searchInAll('xav');
        $resultSearchFilter = json_decode($test);
        $res = $resultSearchFilter->{'hits'}->{'hits'};
        print_r($res[0]->{'_source'});
        return $this->render('catalogue.html.twig', [
            "livres" => $livres->getAllItem()
        ]);
    }
}