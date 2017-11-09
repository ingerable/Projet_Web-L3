# W31 - Programmation web côté serveur

Bienvenue dans ce module :-)

Ce dépôt constitue le point de départ de votre dépôt de travail pour le module.
Des ressources nécessaires à la réalisation des TP y seront ajoutées au fur et à mesure.

La suite de ce fichier contient des instructions concernant la gestion de votre dépôt git.

## Gestion du dépôt

Faites un **fork** de ce dépôt de manière à en avoir une copie qui vous appartienne et dans laquelle vous pourrez ajouter vos réalisations.
Passez sa visibilité à "Private" (section "Settings" -> "General" -> "Sharing and permissions" -> "Project Visibility").
Ajoutez ensuite votre enseignant de TP en tant que "Reporter" de votre dépôt (section "Members").

---

En premier lieu, assurez-vous que git est correctement installé sur votre machine de travail.
Si ce n'est pas encore fait, configurez les informations de l'utilisateur utilisé pour signer les commits.
```sh
git config --global user.name "[Prenom] [Nom]"
git config --global user.email "[username]@unistra.fr"
```

Vous pouvez maintenant **cloner** votre dépôt sur votre machine de travail.
```sh
git clone git@git.unistra.fr:[username]/W31.git
```
Vous vous retrouvez alors avec un dossier W31 qui contient une copie locale de votre dépôt dans laquelle vous allez pouvoir travailler.
Commencez par ajouter le dépôt de départ en tant que remote (nommée ici "prof") :
```sh
git remote add prof git@git.unistra.fr:W31/W31.git
```
Vérifiez grâce à la commande suivante que vous avez bien 2 remotes, "origin" qui est votre dépôt personnel sur GitLab, et "prof" qui est celui de départ :
```sh
git remote -v
```

---

A tout moment, vous pouvez *inspecter l'état actuel* de votre dépôt grâce à la commande :
```sh
git status
```
Vous pourrez par exemple voir si il y a dans votre dépôt des fichiers qui ne sont pas encore *sous contrôle*.
Si c'est le cas et que vous souhaitez les *ajouter au dépôt*, vous pouvez faire :
```sh
git add [file]
```
Si des fichiers sous contrôle ont été *modifiés* et que vous souhaitez valider ces modifications, vous pouvez également faire :
```sh
git add [file]
```
Ces commandes d'ajout (**add**) permettent d'informer git de l'ensemble des modifications que l'on souhaite valider pour le prochain **commit**.
Les **commits** sont les éléments de base qui constituent les étapes successives de l'état du dépôt.

Une fois que vous êtes contents de vos modifications et que vous avez ajouté pour le prochain **commit** l'ensemble des fichiers souhaités, vous pouvez faire effectivement ce nouveau **commit** :
```sh
git commit
```
Votre éditeur de texte par défaut va s'ouvrir afin que vous puissiez une dernière fois voir la liste des fichiers concernés, et saisir un **commentaire** (obligatoire) accompagnant le commit.

---

Afin d'envoyer les commits effectués sur votre dépôt local vers votre dépôt sur GitLab ("origin"), vous pouvez exécuter la commande :
```sh
git push
```
Si vous souhaitez travailler sur plusieurs machines, vous pouvez cloner votre dépôt sur chacune de vos machines (ainsi qu'ajouter la remote "prof").
Avant de commencer à travailler, pour récupérer en local les commits que vous n'auriez pas sur cette machine, vous pouvez commencer par faire :
```sh
git pull
```
Cette commande va chercher sur la **remote** par défaut ("origin") les **commits** dont vous ne disposeriez pas encore en local et mettre à jour votre copie de travail de sorte qu'elle intègre ces nouveaux commits.

---

De nouvelles ressources seront ajoutés au fur et à mesure sur le dépôt de départ ("prof").
Afin de les récupérer, vous pouvez exécuter la commande :
```sh
git pull prof master
```
