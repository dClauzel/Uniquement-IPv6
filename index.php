<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<title>Ce site web est consultable uniquement par IPv6</title>
	<meta name="description" content="Page d’information pour les connexions en IPv4">
	<meta name="author" content="Damien Clauzel">
	<meta name="dc.rights" content="En ce glorieux jour du 2014-07-20, moi Damien Clauzel place cette page sous la licence « Fais pas chier », https://clauzel.eu/FPC/">
	<style>
		html, body {
			margin: 0;
			height: 100%;
			display: flex;
			flex-flow: column wrap;
			align-items: center;
			justify-content: center;
		}
		body {
			text-align: justify;
			max-width: 50%;
		}
		p {
			font-family: serif;
		}
		h1 {
			font-family: sans-serif;
			font-weight: bold;
			font-size: x-large;
		}
		code {
			background: lightYellow;
			font-family: monospace;
			text-align: left;
	}
	</style>
</head>
<body>

<h1>Demande de page par IPv6</h1>
<p>Félicitation, vous avez chargé cette page par IPv6. Si vous l’aviez demandé par IPv4, vous auriez été redirigé sur la <a href=ipv4.html>page <strike>de propagande</strike> d’explications</a>.

<p>Pour information, voici les en-tête des réponses données par le serveur web, suivant qu’on l’interroge en IPv4 ou en IPv6 :
<pre><code>
$ curl -4 --head https://clauzel.eu/Uniquement%20IPv6/
HTTP/1.1 307 Temporary Redirect
Date: Mon, 21 Jul 2014 13:20:08 GMT
Server: Apache
Strict-Transport-Security: max-age=31536000; includeSubDomains
Location: https://clauzel.eu/Uniquement%20IPv6/ipv4.html
Content-Type: text/html; charset=iso-8859-1

$ curl -6 --head https://clauzel.eu/Uniquement%20IPv6/
HTTP/1.1 200 OK
Date: Mon, 21 Jul 2014 13:20:34 GMT
Server: Apache
Strict-Transport-Security: max-age=31536000; includeSubDomains
Content-Type: text/html; charset=UTF-8
</code></pre>

<h1>Technique</h1>
<p>L’attrapage des adresses IPv4 se fait par les règles dans le fichier <code>.htaccess</code> :

<pre><code>
<?php
	include(".htaccess");
?>
</code></pre>

<p>Cette redirection est volontairement simple, pour montrer la mise en œuvre. Elle attrape <em>toutes</em> les requêtes arrivant par IPv4, pour les envoyer vers la page de blocage. Cela comprend donc les ressources appelées par la page : les images, les feuilles de style, les polices, etc.

<p>Le code de retour <code>307 Temporary Redirect</code> est possiblement pas le plus adapté : en effet, il s’agit d’une erreur de transport (IPv4 alors qu’IPv6 est attendu), traitée en fallback par une redirection.

<p>Étant très mauvais dans l’utilisation du mod_rewrite, je suis persuadé qu’on peut faire bien mieux. Je vous invite à me le dire sur Twitter <a href=https://Twitter.com/dclauzel/>(@dClauzel)</a> et <a href=https://pay.reddit.com/r/ipv6/comments/2bapff/project_web_site_only_accessible_by_ipv6_with/>ReddIt</a>; nous en discuterons avec les autres personnes intéressées.

</body>
</html>
