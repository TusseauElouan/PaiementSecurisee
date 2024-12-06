# **PaiementSecurisee**

Une application Laravel robuste pour gérer des paiements sécurisés, avec des fonctionnalités comme les remboursements et la gestion des utilisateurs.

---

## **Prérequis**

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- **PHP 8.x**  
- **Composer**  
- **Node.js** & **npm**  
- **MySQL** ou tout autre système de gestion de base de données pris en charge par Laravel.  

---

## **Installation**

### Étape 1 : Mettre à jour les dépendances PHP
```bash
composer update
```

### Étape 2 : Installer les dépendances front-end
```bash
npm install
```

### Étape 3 : Compiler les ressources front-end
```bash
npm run dev
```

### Étape 4 : Configurer la base de données
Appliquez les migrations pour configurer les tables nécessaires :  
```bash
php artisan migrate
```

### Étape 5 : Seeder les données
#### Ajouter les rôles et utilisateurs par défaut :
```bash
php artisan db:seed --class=RoleAndUserSeeder
```
#### Ajouter des paiements de démonstration :
```bash
php artisan db:seed --class=PaiementSeeder
```

---

## **Démarrage de l'application**

Une fois l'installation terminée, lancez le serveur de développement Laravel avec la commande suivante :  
```bash
php artisan serve
```
Accédez à l'application via [**http://localhost:8000**](http://localhost:8000).

---

## **Notes importantes**

- **Configuration** : Assurez-vous de bien remplir le fichier `.env` avec vos paramètres de base de données et autres configurations avant d'exécuter les commandes artisan.  
- **Permissions utilisateur** : Pour les fonctionnalités avancées (comme les remboursements ou la gestion des rôles), vous devrez peut-être configurer un système comme [**Bouncer**](https://github.com/JosephSilber/bouncer) ou [**Spatie**](https://spatie.be/docs/laravel-permission).  
- **Support** : En cas de problème, consultez la [documentation officielle de Laravel](https://laravel.com/docs) ou demandez de l'aide.  

---

