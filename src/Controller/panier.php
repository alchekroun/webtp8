<?php


namespace App\Controller;


use App\Repository\articleRepository;
use App\Repository\panierRepository;
use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class panier
 * @package App\Controller
 * @Route("/panier")
 */
class panier extends AbstractController
{
    /** @var  Client */
    private $redisClient;

    public function __construct()
    {
        $this->redisClient = RedisAdapter::createConnection(
            'redis://localhost'
        );
    }

    /**
     * @return Response
     * @Route("/", name="panier")
     */
    public function index(): Response
    {
        $articleRepo = new articleRepository();

        $output = [];

        if($this->redisClient->exists('panier')){
            $panier = $this->redisClient->smembers('panier');
            foreach ($panier as $key){
                $tmp[$this->redisClient->get($key)] = $articleRepo->getItemById($key);
                array_push($output, $tmp);
                $tmp = [];
            }
        }

        return $this->render('panier/index.html.twig', [
            "panier" => $output
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @Route("/ajouter/{id}", name="panier_ajouter", requirements={"id"="\d+"})
     */
    public function ajouter(int $id): Response
    {
        $panierRepo = new panierRepository();

        $panierRepo->ajouterItem($id);

        return $this->redirectToRoute('panier');
    }

    /**
     * @param int $id
     * @return Response
     * @Route("/retirer/{id}", name="panier_retirer", requirements={"id"="\d+"})
     */
    public function retirer(int $id): Response
    {
        $panierRepo = new panierRepository();

        $panierRepo->retirerItem($id);

        return $this->redirectToRoute('panier');
    }

}