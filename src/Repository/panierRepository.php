<?php


namespace App\Repository;

use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use App\Repository\articleRepository;

class panierRepository
{
    /** @var  Client */
    private $redisClient;

    public function __construct()
    {
        $this->redisClient = RedisAdapter::createConnection(
            'redis://localhost'
        );
    }

    public function ajouterItem($id){

        $ttl_5mn = 60 * 5; // 5mn expiration

        if($this->redisClient->exists($id)){
            $this->redisClient->incr($id);
        } else {
            $this->redisClient->sadd('panier', (array) $id);
            $this->redisClient->incr($id);
        }
        // On prolonge la durée de vie du panier à chaque interaction
        $this->redisClient->expire('panier', $ttl_5mn);
        $this->redisClient->expire($id, $ttl_5mn);
    }

    public function retirerItem($id){

        $ttl_5mn = 60 * 5; // 5mn expiration

        if($this->redisClient->exists($id)){
            if($this->redisClient->get($id) > 1 ) {
                $this->redisClient->decr($id);
                $this->redisClient->expire($id, $ttl_5mn);
            } else {
                $this->redisClient->del((array) $id);
                $this->redisClient->srem('panier', $id);
            }
            // On prolonge la durée de vie du panier à chaque interaction
            $this->redisClient->expire('panier', $ttl_5mn);
        }
    }

    /*
    public function getPanier(){
        $ids = [];

        if($this->redisClient->exists('panier')){
            $panier = $this->redisClient->smembers('panier');
            foreach ($panier as $key){
                $output[$key] = $this->redisClient->get($key);
            }
        }
        return $ids;

        $articleRepo = new articleRepository();

        return $articleRepo->getAllItemInArray($ids);
    }
    */

    public function viderPanier(){
        // $redis = $this->getRedis();

    }

}