## Gestion d'utilisateurs - Base de données

- A partir de l'exercice précédent (signin, welcome, signout), faire en sorte de stocker les utilisateurs dans une table "Users" d'une base de données MySQL.
- Les mots de passe doivent être stockés hachés

- Ecrire le programme PHP "signup.php" qui, lorsqu'il est appelé par une requête HTTP GET, renvoie un document HTML contenant un formulaire permettant à un utilisateur de s'inscrire en renseignant un identifiant, un mot de passe ainsi qu'une confirmation du mot de passe.
- Modifier ce programme PHP pour qu'il réceptionne ce formulaire soumis par une requête HTTP POST, stocke le couple (identifiant, mot de passe chiffré) en base de données, puis demande au client de se rediriger vers le programme "signin.php". Dans le cas où l'identifiant demandé est déjà utilisé, le programme demande au client de se rediriger vers le programme "signup.php".
