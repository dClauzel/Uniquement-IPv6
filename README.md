Rendre un site web consultable uniquement par IPv6
==================================================

Le vendredi, c’est trolldi.

Vendredi dernier, j’ai eu l’idée de ce petit projet : attraper toutes les requêtes arrivant par IPv4 sur l’apache, et les rediriger vers une page ~~de propagande~~ d’information. Les requêtes arrivant par IPv6 passant directement sans altérations.

Cette technique peut être utilisée — avec différentes approches (message pop-in, inclusion de bannière, page captive, etc.) — pour informer le visiteur de la nécessité impérative de faire évoluer sa connexion à internet, sous peine de ne plus pouvoir consulter le site web.

Technique
---------

Le fichier `.htaccess` filtre les IP des requêtes entrantes, et redirige tous les IPv4 vers la page de propagande. Les IPv6 sont ignorées, et donc transmise à apache.

Cette redirection est volontairement simple, pour montrer la mise en œuvre. Elle attrape *toutes* les requêtes arrivant par IPv4, pour les envoyer vers la page de blocage. Cela comprend donc les ressources appelées par la page : les images, les feuilles de style, les polices, etc.

Le code de retour `307 Temporary Redirect` est possiblement pas le plus adapté : en effet, il s’agit d’une erreur de transport (IPv4 alors qu’IPv6 est attendu), traitée en fallback par une redirection.

Étant très mauvais dans l’utilisation du `mod_rewrite`, je suis persuadé qu’on peut faire bien mieux.

Licence
-------

En ce glorieux jour du 2014-07-20, moi Damien Clauzel place cette page sous la licence « [Fais pas chier](https://clauzel.eu/FPC/) ».
