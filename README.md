# Cook'inn
Projet Wordpress pour la fameuse école HETIC

## Setup 
Le projet est sur docker, pour le démarrer, après le clone, lancer :
````
docker-compose up -d
````
Aller dans le thème wik et installer les packages :
````
cd app/wp-content/themes/wik-theme
yarn
````
Puis soit en prod juste build les styles :
````
yarn build
````
Ou lancer le serveur de dev :
````
yarn dev
````
Ouvrir votre navigateur à (cette)[http://localhost:2345] adresse 

Et pour accéder à php my admin aller (ici)[http://localhost:8080]

## Utilisateurs par défauts
- Admin : usr = admin, pwd = admin
- Modérateur (recette/commentaires) : usr = moderator, pwd = moderator
- Utilisateur lambda : un formulaire est à votre dispo pour vous inscrire (ici)[http://localhost:2345/inscription]

## Infrastructure
Voir (ici)[./INFRASTRUCTURE.md]
