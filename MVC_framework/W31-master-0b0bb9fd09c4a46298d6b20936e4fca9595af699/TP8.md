## Premier serveur HTTP

Écrire un programme Node.JS qui crée un serveur HTTP.
 - à chaque requête, la route demandée est loguée dans la console.
 - à une requête à la route '/', le serveur répond un document HTML (avec ce que vous voulez).
 - à une requête à la route '/hello', le serveur répond un document HTML qui souhaite la bienvenue à l'utilisateur dont le nom aura été fourni dans une variable de la querystring.
 - à une requête à toute autre route, le serveur répond un code d'erreur 404 et un document HTML qui indique que la ressource demandée n'existe pas.

## Serveur de fichiers statiques

Écrire un programme Node.JS qui crée un serveur HTTP qui étant donné une route, cherche un fichier portant ce nom et ayant l'extension ".html" puis renvoie ce fichier.

Si le fichier n'existe pas, un fichier "404.html" indiquant l'absence de la ressource demandée est lu et retourné avec un code d'erreur 404.

*Indications* : regardez du côté du package `fs` et de la constante `__dirname`

## Express - static

Écrire un programme Node.JS qui crée un serveur Express.

Créer des fichiers HTML au sein d'un dossier "public".

Ajouter un premier middleware inconditionnel qui retourne un fichier du dossier "public" si il y en a un qui correspond à la route demandée (voir la fonction express.static).

Ajouter un second middleware qui est appelé en cas de requête GET à la route '/' et qui retourne le fichier "home.html" du dossier "public".

Ajouter un dernier middleware inconditionnel qui retourne un code d'erreur 404 et le fichier "404.html".

## Express - routes simples

Ajouter au programme précédent un middleware qui est appelé en cas de requête GET à la route '/hello' et qui répond un document HTML qui souhaite la bienvenue à l'utilisateur dont le nom aura été fourni dans une variable de la querystring.

Ajouter un middleware qui est appelé en cas de requête GET à la route '/hello/:user' et qui répond un document HTML qui souhaite la bienvenue à l'utilisateur dont le nom est fourni dans le paramètre de la route.

## Express - templates Mustache

Modifier le programme précédent pour utiliser le moteur de templates Mustache.

Créer un dossier "views".

Créer une vue "home.mustache" destinée à être utilisée lors d'une requête GET à la route '/'. Cette vue attend une variable `title` fournie lors de l'appel à la fonction `render`. Ce titre peut être utilisé comme titre du document HTML et dans le corps du document.

Créer une vue "hello.mustache" destinée à être utilisée lors d'une requête GET à la route '/hello'. Cette vue attend en plus une variable `user` fournie lors de l'appel à la fonction `render`.

Ajouter un middleware qui est appelé en cas de requête GET à la route '/messages' et qui répond un document HTML qui affiche une liste de messages avec leur auteur. Les messages sont fournis à la vue Mustache sous forme d'un tableau d'objets contenant chacun un champ "author" et un champ "text".

## Application Messages v1

Écrire une application Express qui gère une liste de messages (un message ayant un auteur et du texte).
 - à la route '/messages' en GET, le serveur répond un document HTML avec la liste des messages ainsi qu'un formulaire permettant de poster un nouveau message.
 - à la route '/messages' en POST, le serveur réceptionne le formulaire, ajoute le message à sa liste, puis redirige le client vers la route '/messages'.

Utiliser le module `body-parser`.

Les vues seront générées avec Mustache.

Les messages seront stockés dans un tableau en Javascript.
