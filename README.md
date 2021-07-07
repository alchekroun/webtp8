# Amazon-bis (webtp8)

## Technologies utilisées

- Architecture : Symfony 5.3
- Recherche d'article : ElasticSearch
- Persistance des articles : MongoDB
- Panier : Redis
- Commande et Utilisateurs : MySQL

## Premier lancement

Vous devez suivre les instructions suivantes avant le premier lancement du serveur.

1. Créer un utilisateur webtp6, et la bdd éponyme, son mdp sera : "webtp6"
2. Dans la console :

⋅⋅* Préparer la migration
```
php bin/console make:migration
```
⋅⋅* Migrer
```
php bin/console doctrine:migrations:migrate
```

3. Pour peupler la BDD MongoDB veuillez copier coller dans une console mongo le contenu du fichier seed.txt

4. Lancez les serveurs suivants : MAMP (Apache MySQL), Redis, MongoDB et ElasticSearch

## Fonctionalité diponible

Acheter un livre sur la plateforme aisément 
