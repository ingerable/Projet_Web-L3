## Gestion d'utilisateurs

- Écrire le programme PHP `signin.php` qui, lorsqu'il est appelé par une requête HTTP GET, renvoie un document HTML contenant un formulaire permettant à un utilisateur de s'authentifier à l'aide de son identifiant et de son mot de passe.

- Modifier ce programme PHP pour qu'il réceptionne ce formulaire soumis par une requête HTTP POST, vérifie dans un tableau déclaré en dur que l'utilisateur existe et que son mot de passe est correct. Si l'authentification échoue, le programme demande au client de se rediriger vers le programme `signin.php`. Si l'authentification réussit, une session est créée pour ce client dans laquelle l'identité de l'utilisateur connecté est mémorisée puis le programme demande au client de se rediriger vers le programme `welcome.php`.

- Écrire le programme PHP `welcome.php`. Si le client n'est pas considéré comme connecté, le programme demande au client de se rediriger vers le programme `signin.php`. Si le client est considéré comme connecté, le programme renvoie un document HTML lui indiquant son identité ainsi qu'un lien vers le programme `signout.php`.

- Écrire le programme PHP `signout.php` qui efface l'identité de l'utilisateur connecté de la session courante, puis demande au client de se rediriger vers le programme `signin.php`.
