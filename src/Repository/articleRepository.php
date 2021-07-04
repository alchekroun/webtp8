<?php

namespace App\Repository;

use MongoDB\Client as Mongo;


class articleRepository
{
    public function getMongo(){
        return new Mongo("mongodb://localhost");
    }

    public function getAllItem(){
        $livres = $this->getMongo()->bibliotheque->articles;
        return $livres->find()->toArray();
    }

    /*public function test()
    {
        $dbconn = pg_connect("host=localhost dbname=bibliotheque user=postgres password=0000");

        if (!$dbconn) {
            echo "Une erreur s'est produite.\n";
            exit;
        }

        $result = pg_query($dbconn, "SELECT * FROM users");
        if (!$result) {
            echo "Une erreur s'est produite.\n";
            exit;
        }

        while ($row = pg_fetch_row($result)) {
            echo "Auteur: $row[0]  E-mail: $row[1]";
            echo "<br />\n";
        }
    }*/
}