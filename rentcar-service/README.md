# RentCar Pro - Laravel + MySQL + XAMPP

Application professionnelle simple pour gérer un service de location de voitures, avec interface en français et connexion administrateur.

## Fonctionnalités

- Connexion / déconnexion administrateur
- Protection des pages par authentification Laravel
- Tableau de bord en français
- Gestion des voitures: ajout, modification, suppression, recherche
- Gestion des clients: ajout, modification, suppression, recherche
- Gestion des réservations
- Calcul automatique du prix total
- Statuts: disponible, louée, maintenance, active, terminée, annulée
- Design admin moderne
- Code commenté dans les modèles, contrôleurs et authentification

---

## Compte administrateur par défaut

Après exécution du seeder:

```text
Email: admin@rentcar.local
Mot de passe: admin123
```

Vous pouvez modifier ce compte dans:

```text
database/seeders/DatabaseSeeder.php
```

---

## Prérequis

Installez et lancez:

1. XAMPP
2. PHP inclus avec XAMPP
3. MySQL via XAMPP
4. Composer

Dans XAMPP Control Panel, démarrez:

- Apache
- MySQL

---

## Installation étape par étape sur Windows avec XAMPP

### 1. Créer le projet Laravel

Ouvrez CMD:

```bat
cd C:\xampp\htdocs
composer create-project laravel/laravel rentcar-service
```


### 3. Créer la base de données MySQL

Ouvrez phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Créez une base de données:

```text
rentcar_service
```

Collation recommandée:

```text
utf8mb4_unicode_ci
```

### 4. Configurer Laravel avec MySQL

Dans le fichier:

```text
C:\xampp\htdocs\rentcar-service\.env
```

Mettez:

```env
APP_NAME="RentCar Pro"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rentcar_service
DB_USERNAME=root
DB_PASSWORD=
```

Avec XAMPP, le mot de passe MySQL est souvent vide par défaut.

### 5. Générer la clé Laravel

```bat
cd C:\xampp\htdocs\rentcar-service
php artisan key:generate
```

### 6. Migrer les tables et créer le compte admin

```bat
php artisan migrate:fresh --seed
```

Cette commande crée les tables, ajoute les voitures/clients de test et crée l'admin:

```text
admin@rentcar.local / admin123
```

### 7. Lancer l'application

```bat
php artisan serve
```

Ouvrez dans votre navigateur:

```text
http://localhost:8000/login
```

Connectez-vous avec le compte administrateur.

---

## Fichiers importants ajoutés

```text
app/Http/Controllers/AuthController.php
resources/views/auth/login.blade.php
routes/web.php
resources/views/layouts/app.blade.php
public/css/rentcar.css
database/seeders/DatabaseSeeder.php
```

---

## Modifier le mot de passe admin

Dans `database/seeders/DatabaseSeeder.php`, changez:

```php
'password' => Hash::make('admin123'),
```

Puis relancez:

```bat
php artisan db:seed
```

Ou, pour tout reconstruire:

```bat
php artisan migrate:fresh --seed
```

---

## Problèmes fréquents

### Composer n'est pas reconnu

Ajoutez Composer au PATH Windows ou réinstallez Composer.

### Erreur MySQL connection refused

Vérifiez que MySQL est démarré dans XAMPP.

### Table users inexistante

Le projet Laravel neuf contient normalement la migration `users`. Lancez:

```bat
php artisan migrate:fresh --seed
```

### Page CSS non chargée

Vérifiez que le fichier existe:

```text
public/css/rentcar.css
```

---

## Mise à jour ajoutée: dashboard clients + permissions multi-utilisateurs

Cette version ajoute:

- Liste des derniers clients directement sur le tableau de bord
- Module **Utilisateurs & permissions** visible uniquement pour l'administrateur
- Deux rôles:
  - **admin**: accès complet, gestion voitures et utilisateurs
  - **car_manager**: peut consulter le parc et gérer l'opérationnel, mais ne peut pas ajouter/modifier/supprimer les voitures ni gérer les utilisateurs
- Interface plus professionnelle avec thème automobile: cartes véhicules, fond pattern, hero visuel et badges de statut

### Comptes de test

```text
Admin:
Email: admin@rentcar.local
Mot de passe: admin123

Car manager:
Email: manager@rentcar.local
Mot de passe: manager123
```

