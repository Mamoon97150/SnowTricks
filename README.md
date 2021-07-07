# SnowTricks

Snowtricks est un site collaboratif pour faire connaître le snowboard auprès du grand public et aider à l'apprentissage des figures (tricks).

## Environnement de développement

### Pré-requis
-   Docker
-   Docker-compose

Vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (de la CLI de Symfony)

```bash
 symfony check:requirements
```

### Lancer l'environnement de développement

Créez un dossier mysql à la racine du projet. Puis entrez les commande suivante :
```bash
    docker-compose up -d
```

L'environnement de developpement est lancé !!

### Ajouter les dépendances

Ouvrez un terminal a la racine du projet et eécutez les commandes suivantes :

```bash
    cd app
    composer install
    npm install
    npm run build (ou yarn build)
```

### Installer la base de données
```bash
    php bin/console doctrine:database:create
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
    php bin/console doctrine:fixtures:load
```
### Utilisateur 
Il existe 2 utilisateur déjà crée dans la base de données : Jane2021(password1) et John2021(password2)

### Lancer les tests

```bash
php bin/phpunit --testdox
```