<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\articleRepository;
use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class commande
 * @package App\Controller
 * @Route("/commande")
 */
class CommandeController extends AbstractController
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
     * @Route("/", name="commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $this->getUser()->getCommandes()
        ]);
    }

    /**
     * @return Response
     * @Route("/traitement", name="traitement_commande")
     */
    public function traitementCommande(): Response
    {
        // TODO Logique métier BDD appeler fonction dans le repository
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $em = $this->getDoctrine()->getManager();

        $articleRepo = new articleRepository();

        $prix = 0;


        $commande = new Commande();
        $commande->setDate(new \DateTime('now'));

        if($this->redisClient->exists('panier')){
            $panier = $this->redisClient->smembers('panier');
            foreach ($panier as $key){
                $prix += floatval($this->redisClient->get($key)) * floatval($articleRepo->getItemById($key)["prix"]->__toString());
                $articleRepo->updateQuantity($key, $this->redisClient->get($key));
                $this->redisClient->del((array) $key);
                $this->redisClient->srem('panier', $key);
            }
        }
        $commande->setPrix($prix);
        $em->persist($commande);
        $this->getUser()->addCommande($commande);
        $em->flush();

        return $this->redirectToRoute('commande');
    }
}
