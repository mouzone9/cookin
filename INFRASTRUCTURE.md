# INFRASTRUCTURE

## Liens
DEV : http://185.189.156.162/
PROD : http://20.199.107.238/

## Scripts de déploiement et actions
Pour déployer un script de déploiement est présent sur la dev et la prod : 
```
#!/bin/bash
#CONFIG
rootDir="/home/debian/"
repoPath="${rootDir}/cookin/"
oldSiteUrl="http://localhost:2345"
siteUrl='http://185.189.156.162/'
saveDbFileName="${rootDir}/save_bdd.sh"

echo "START DEPLOYING"

# Sauvegarde la base de donnée
bash $saveDbFileName

# Se place dans le bon dossier et kill docker
cd $repoPath
sudo docker-compose down --remove-orphans

# Pull github pour être à jour 
git pull --rebase
git checkout develop

# Va build les styles et le js
cd $repoPath/app/wp-content/themes/wik-theme/
yarn
yarn build

# Relance docker
sudo docker-compose up -d

# Attend 6s (le temps que la bdd soit bien lancée)
sleep 6

# Met la bonne url de site dans wordpress (database + options)
sudo docker-compose exec -T php wp option update home $siteUrl --allow-root
sudo docker-compose exec -T php wp option update siteurl $siteUrl --allow-root
sudo docker-compose exec -T php wp search-replace $oldSiteUrl $siteUrl --allow-root

echo "DEPLOY FINISHED"
```
Qui est appelé par les "github actions" ([ici](https://github.com/mouzone9/cookin/tree/main/.github/workflows) en ssh

## Sauvegarde des bases de données 
Script de sauvegarde :
```
#!/bin/bash
#CONFIG
rootDir=/home/debian/
backupDirName=backups
repoName=cookin

# Vérifie que le dossier ou les backups doivent se placer existe bien
mkdir $rootDir/$backupDirName/ -p

#Génère les bons noms de fichier
NOW=$(date +"%m-%d-%y_%T")
filename="backup.$NOW.sql"
echo "Backuping data into $filename..."

#Se place dans le bon dossier et fait un dump au bon endroit et avec le bon nom
cd $rootDir/$repoName
sudo docker-compose exec db mysqldump -uroot --password=password --databases data > $rootDir/$backupDirName/$filename
```

Une sauvagarde est faite avant chaque déploiement et tous les jours à minuit grâce à ce cron :
``0 0 * * * bash ~/save_bdd.sh``.

## Configuration Nginx
Comme notre wordpress tourne entièrement sur un docker on utilise nginx pour faire un reverse proxy, voici la conf :
```
server {
  listen 80;
  listen [::]:80;
  server_name _;
  location / {
        proxy_set_header X-Real-IP  $remote_addr;
        proxy_set_header X-Forwarded-For $remote_addr;
        proxy_set_header Host $host;
        proxy_redirect off;
        proxy_pass http://localhost:2345;
  }
}
```
