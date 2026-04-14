# Mediatekformation
Mediatek Formation est un catalogue de formation en ligne.

### [Le site](https://www.mediatek-formation.fr) 
### [Présentation du projet]() 
### [Le projet de départ](https://github.com/CNED-SLAM/mediatekformation) 

## Les pages du back-office

### Page 1 : les formations

<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/92c6b59b-e22f-4134-9eb7-b5a9fc736992" />
<br>
Cette première page fait office de page d'accueil et offre la possibilité de filtrer les formations de la même manière que dans la partie front. Trois boutons ont cependant été ajoutés : "Modifié" et "Ajouter" qui permettent d'accéder à un formulaire d'une formation existante ou nouvelle, ainsi que le bouton "Supprimer" qui permet de supprimer une formation à la suite d'une demande de confirmation.

### Page 2 : le formulaire des formations

<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/f9db8fd6-f07f-498f-beda-04761548bbb5" />
<br>
Ce formulaire s'ouvre dès qu'on veut créer ou modifier une formation, seule le titre est obligatoire, une formation peut avoir plusieurs catégories mais ne peut appartenir qu'à une seule playlist.

### Page 3 : les playlists
<img width="1916" height="1076" alt="image" src="https://github.com/user-attachments/assets/ced98407-c47c-4eff-989a-e2eced416382" />
<br>
Cette page recense les playlists disponibles ainsi que le nombre de formations qui les composent. Il est possible de les filtrer de la même manière que dans la partie front. Trois boutons ont été ajoutés : "Modifié" et "Ajouter" qui permettent d'accéder à un formulaire d'une playlist existante ou nouvelle, ainsi que le bouton "Supprimer" qui permet de supprimer une playlist à la suite d'une demande de confirmation et uniquement si la playlist est vide.

### Page 4 : le formulaire des playlists
<img width="1917" height="1079" alt="image" src="https://github.com/user-attachments/assets/603913cf-44a7-49c5-b4a0-219c98af5695" />
<br>
Ce formulaire s'ouvre dès qu'on veut créer ou modifier une playlist, seule le titre est obligatoire. Si la playlist est rattachée à une formation, celle-ci sera affichée sur le côté droit.

### Page 5 : les catégories
<img width="1919" height="1078" alt="image" src="https://github.com/user-attachments/assets/9801e6ae-00fc-45d9-92a9-806014495b5f" />
<br>
Liste des catégories avec la possibilité de les filtrer et trier. Il est possible d'en ajouter avec le bouton "Ajouter une catégorie" et d'en supprimer avec le bouton "Supprimer" après une demande de confirmation et uniquement si la catégorie n'est associée à aucune formation.

## Test de l'application en local :

-Installer  [Symfony CLI](https://symfony.com/download).  
Telecharger la branche prod de l'application

```bash
symfony composer install #a la racine du projet
````
-Installer [WampSever](http://www.wampserver.com/) :
Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.
- Dans phpMyAdmin, se connecter à MySQL en root sans mot de passe et créer la BDD 'mediatekformation'.
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour remplir la BDD
- Ouvrir l'application dans un IDE professionnel.
