Rendre un site web consultable uniquement par IPv6
==================================================

Le vendredi, c’est trolldi.

Vendredi dernier, j’ai eu l’idée de ce petit projet : attraper toutes les requêtes arrivant par IPv4 sur l’apache, et les rediriger vers une page ~~de propagande~~ d’information. Les requêtes arrivant par IPv6 passant directement sans altération.

Cette redirection peut être utilisée — avec différentes approches (message pop-in, inclusion de bannière, page captive, etc.) — pour informer le visiteur de la nécessité impérative de faire évoluer sa connexion à internet, sous peine de ne plus pouvoir consulter le site web.

Technique
---------

Le fichier `.htaccess` filtre les IP des requêtes entrantes, et redirige toutes les IPv4 vers la page de propagande. Les IPv6 sont ignorées, et donc transmises à apache.

Cette redirection est volontairement simple, pour montrer la mise en œuvre. Elle attrape *toutes* les requêtes arrivant par IPv4, pour les envoyer vers la page de blocage. Cela comprend donc les ressources appelées par la page : les images, les feuilles de style, les polices, etc.

Le code de retour `307 Temporary Redirect` est possiblement pas le plus adapté : en effet, il s’agit d’une erreur de transport (IPv4 alors qu’IPv6 est attendu), traitée en fallback par une redirection.

Étant très mauvais dans l’utilisation du `mod_rewrite`, je suis persuadé qu’on peut faire bien mieux.

Discussion
----------

Les avantages de s’appuyer sur le .htaccess sont :

* simple à mettre en œuvre, sans intervention d’un administrateur système
* ne nécessite pas de modifier la configuration générale d’apache (définition de vhosts, binding, etc)
* un seul prérequis standard (mod_rewrite)
* une portée ciblée sur des répertoires choisis, ou même un seul fichier
* la possibilité de déployer sur un hébergement mutualisé

Une autre technique possible est de mettre en place 2 vhosts: celui en IPv4 fournissant le contenu réel, et celui en IPv4 fournissant la page de blocage.

Ceci dit, attention: le principale problème du filtrage des requêtes arrivant en IPv4 est qu’en cas de dual stack IPv4/IPv6 on empêche l’utilisation du [Happy Eyeballs](https://en.wikipedia.org/wiki/Happy_Eyeballs).

Licence
-------

En ce glorieux jour du 2014-07-20, moi Damien Clauzel place ce travail sous la licence « [Fais pas chier](https://clauzel.eu/FPC/) ».
