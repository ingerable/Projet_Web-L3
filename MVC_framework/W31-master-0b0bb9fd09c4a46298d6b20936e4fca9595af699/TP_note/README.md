TP noté
-------

### Contexte

A l'aide du framework MVC utilisé dans les TP précédents, vous devez réaliser une application de suivi individuel d'activités sportives : elle doit permettre à un utilisateur de gérer (ajouter/supprimer/modifier) les résultats de ses différentes séances sportives et proposer diverses statistiques.

### Base de données

Le modèle de données utilisé est composé des 3 tables suivantes :

- Users : id (int,11), login (varchar,255), password (varchar,255)
- Activities : id (int,11), title (varchar,255)
- Sessions : id (int,11), user_id (int,11), activity_id (int,11), day (date), distance (int,11), duration (int,11)

Dans la table `Sessions`, les colonnes `user_id` et `activity_id` sont des clés étrangères référençant les colonnes `id` des tables `Users` et `Activities`.
La colonne `distance` exprime une distance en mètres.
La colonne `duration` exprime une durée en minutes.

Le fichier `init_db.sql` contient un script SQL permettant de créer ces tables avec leurs contraintes.
Vous pouvez utiliser ce script dans l'interface de PhpMyAdmin comme expliqué ci-après.
Ce script crée également trois enregistrements dans la table `Activities` : course, natation et vélo.

### Démarrer le TP

1. Après avoir exécuté la commande le `git pull prof master`, vous avez accès au répertoire `TP_note` qui contient l'arborescence suivante :
	- `MVC_framework` : contient le framework de base qui vous avait été fournit au début du TP 5. C'est dans ce répertoire que vous devrez développper l'application de suivi individuel d'activités sportives.
	- `init_db.sql` : script d'initialisation de la base de données avec les tables `Users`, `Activities` et `Sessions`.
	- `README.md` : contient l'énoncé du TP noté que vous êtes en train de lire.

2. Importez la base de données dans PhpMyAdmin :
	- Créez une nouvelle base de données depuis http://ss4s.iutrs.unistra.fr
	- Connectez-vous sur PhpMyAdmin à l'adresse http://iin-etu.iutrs.unistra.fr/phpmyadmin/
	- Sélectionner la base de données que vous venez de créer dans l'arborescence du menu de gauche
	- Cliquez sur l'onglet "Import" en haut de l'écran
	- Choisissez `init_db.sql` comme fichier à importer
	- Laissez les champs sélectionnés par défaut et cliquez sur le bouton "Exécuter"

3. Dans le fichier `MVC_framework/global/config.php`, pensez à indiquer le nom de la nouvelle base de données

4. À vous de développer l'application : vous avez le droit d'utiliser tous vos documents personnels (notes, code, ...) !

### Rendu

- Vous devrez "comiter" et "pusher" l'ensemble de votre code pour qu'il soit évalué, comme à la fin de tous les TPs que vous avez fait précédemment.
- Attention, seul les commits effectués AVANT 17h seront pris en compte : pensez à prendre le temps nécessaire à ces opération avant la fin de l'examen !


### Évaluation

- L'évaluation ne tiendra pas compte de la qualité de l'interface et de l'ergonomie : concentrez-vous sur le PHP, pas sur le HTML !
- Les intentions seront prises en compte : si vous savez comment faire mais êtes bloqués par un problème technique, n'hésitez pas à le signaler par un commentaire et à passer aux autres fonctionnalités.


### Fonctionnalités à implémenter

Les fonctionnalités que vous devez coder sont les suivantes :

1. Un visiteur anonyme doit pouvoir : (~6 points)
 - voir la page d'accueil
 - créer un compte
 - se connecter
2. Un utilisateur connecté doit pouvoir : (~14 points)
 - voir ses 3 dernières séances triées par date, de la plus récente à la plus ancienne
 - pour chaque activité de la table `Activities`, voir la liste de ses séances triées par date, de la plus récente à la plus ancienne
 - ajouter une nouvelle séance à partir d'un formulaire contenant les champs suivants :
    - le type d'activité (balise `input` de type `select`)
    - le jour de la séance (balise `input` de type `date`)
    - la distance parcourue en mètres (balise `input` de type `number`
    - la durée de l'activitée en minutes (balise `input` de type `number`)
  - modifier une séance existante (activité, jour, distance, durée) à partir d'un formulaire similaire à celui de la fonctionnalité précédente
  - supprimer une séance existante

> _Indication_ :
> Le champ `day` de type `date` doit être traité comme un chaîne de caractères au format YYYY-MM-DD lors de la construction de la requête avec PDO.
> Il se trouve que c'est dans ce format qu'un élément HTML input de type "date" formate la date lors la soumission du formulaire.


### Bonus

En bonus, si vous avez du temps, vous pouvez ajouter les fonctionnalités suivantes, uniquement accessibles à un utilisateur connecté :
- modifier son mot de passe lorsqu'on est connecté
- afficher pour chaque type d'activité le total des distances parcourues et des durées
- afficher d'autres statistiques comme la vitesse pour chaque séance, la vitesse moyenne par activité, ...
