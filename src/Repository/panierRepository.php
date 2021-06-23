<?php


namespace App\Repository;

use predis;

class panierRepository
{
    public function getRedis(){

        Predis\Autoloader::register();

        return new Predis\Client(
            array(
                "scheme" => "tcp",
                "host" => "localhost",
                "port" => 6379
            )
        );
    }

    public function ajouterItem(int $id){
        $redis = $this->getRedis();

        $ttl_5mn = 60 * 5; // 5mn expiration

        if($redis->exists($id)){
            $redis->incr($id);
            // On prolonge la durée de vie du panier à chaque interaction
            $redis->expire('panier', $ttl_5mn);
        } else {
            $redis->sadd('panier', (array) $id);
            $redis->expire('panier', $ttl_5mn);
            $redis->incr($id);
            $redis->expire($id, $ttl_5mn);
        }
    }

    public function retirerItem(int $id){
        $redis = $this->getRedis();

        $ttl_5mn = 60 * 5; // 5mn expiration

        if($redis->exists($id)){
            $redis->del((array) $id);
            $redis->srem('panier', $id);
            // On prolonge la durée de vie du panier à chaque interaction
            $redis->expire('panier', $ttl_5mn);
        }
    }

    public function getPanier(){
        $redis = $this->getRedis();

        $output = [];

        if($redis->exists('panier')){
            $panier = $redis->smembers('panier');
            foreach ($panier as $key){
                $output[$key] = $redis->get($key);
            }
        }
        return $output;
    }

    public function viderPanier(){
        $redis = $this->getRedis();

    }

}