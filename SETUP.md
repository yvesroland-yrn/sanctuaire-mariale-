# Guide de Configuration - Sanctuaire Notre Dame de Sassako

## 🎯 Étapes de Configuration

### 1. Préparation de l'Environnement

#### Fichier `.env`

Créez un fichier `.env` à la racine du projet (copie de `.env.example`) :

```bash
cp .env.example .env
```

#### Configuration de la Base de Données

Modifiez le fichier `.env` :

```env
# Base de Données MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanctuaire_db
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 2. Création de la Base de Données MySQL

Ouvrez MySQL et créez la base de données :

```sql
-- Créer la base de données
CREATE DATABASE sanctuaire_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer un utilisateur (optionnel)
CREATE USER 'sanctuaire_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';
GRANT ALL PRIVILEGES ON sanctuaire_db.* TO 'sanctuaire_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. Installation des Dépendances

```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances Node.js (si Vite est utilisé)
npm install
```

### 4. Configuration de l'Application

#### Générer la clé d'application

```bash
php artisan key:generate
```

#### Exécuter les migrations

```bash
php artisan migrate
```

Cette commande créera les tables suivantes :
- `users` - Utilisateurs du système
- `actualites` - Actualités du Sanctuaire
- `projets` - Projets en cours
- `conseils` - Conseils spirituels (NEW)
- `statistiques` - Statistiques et KPI
- `pages` - Pages statiques
- `messages` - Messages de contact
- `newsletters` - Abonnements newsletter
- `evenements` - Événements
- `parametres` - Paramètres système

#### Remplir la base de données (optionnel)

```bash
php artisan db:seed
```

Cela exécutera les seeders pour créer un utilisateur administrateur et des données initiales.

### 5. Créer l'Utilisateur Administrateur

Via la console Tinker :

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'nom' => 'Admin',
    'prenom' => 'Sanctuaire',
    'email' => 'admin@sanctuaire.local',
    'password' => Hash::make('password123'),
    'role' => 'admin',
    'statut' => 'actif',
    'telephone' => '+223 XX XX XX XX',
    'adresse' => 'Sassako, Mali'
]);
```

### 6. Configuration des Dossiers de Stockage

```bash
# Créer un lien symbolique pour les fichiers publics
php artisan storage:link

# Définir les permissions correctes
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/storage
```

### 7. Lancer le Serveur de Développement

```bash
# Terminal 1 - Laravel
php artisan serve

# Terminal 2 - Vite (pour les assets)
npm run dev
```

L'application sera accessible sur : `http://localhost:8000`

### 8. Accès au Panel Admin

- URL: `http://localhost:8000/admin/dashboard`
- Email: `admin@sanctuaire.local`
- Mot de passe: `password123`

## 📊 Structure des Modèles

### Users
- Gestion des comptes administrateurs et modérateurs
- Rôles : admin, moderateur, membre
- Statuts : actif, inactif

### Actualites
- Articles et nouvelles du Sanctuaire
- Catégories : actualite, projets, education, communaute, culture, sante
- Statuts : publie, brouillon, archive

### Projets
- Projets d'aide et de développement
- Secteurs : education, sante, eau, infrastructure, energie, agriculture
- Statuts : futur, en-cours, realise
- Suivi d'avancement en pourcentage

### Conseils (NEW)
- Contenus spirituels et conseils
- Catégories : priere, meditations, enseignements, temoignages, conseils
- Statuts : publie, brouillon, archive

### Statistiques
- Métriques et KPI du Sanctuaire
- Suivi par type et date
- Valeurs numériques

## 🛣️ Routes Principales

### Site Public
- `/` - Accueil
- `/propos` - À Propos
- `/projets` - Projets
- `/actualites` - Actualités
- `/conseils` - Conseils Spirituels
- `/contact` - Contact

### Panel Admin (authentifié)
- `/admin/dashboard` - Tableau de bord
- `/admin/actualites` - Gestion des Actualités
- `/admin/projets` - Gestion des Projets
- `/admin/conseils` - Gestion des Conseils
- `/admin/statistiques` - Gestion des Statistiques
- `/admin/utilisateurs` - Gestion des Comptes

## 🔐 Authentification

### Se Connecter
- URL: `http://localhost:8000/connexion`
- Email: `admin@sanctuaire.local`
- Mot de passe: `password123`

### Se Déconnecter
- Bouton dans le panel admin ou formulaire POST vers `/deconnexion`

## 📝 Notes Importantes

1. **Sauvegardes**: Effectuez régulièrement des sauvegardes de la base de données
2. **Fichiers**: Les images et fichiers sont stockés dans le dossier `storage/app/public`
3. **Performance**: Utilisez `php artisan config:cache` en production
4. **Logs**: Les logs d'application sont dans `storage/logs`

## ❌ Troubleshooting

### Erreur : "SQLSTATE[HY000]: General error"
```bash
php artisan migrate:fresh
```

### Permissions refusées
```bash
chmod -R 777 storage bootstrap/cache
```

### Pas d'accès au panel admin
- Vérifier la table users existe
- Vérifier que vous êtes connecté avec un compte admin
- Utiliser `php artisan tinker` pour vérifier l'utilisateur

## 📞 Support

Pour toute question ou problème, consultez :
- Documentation Laravel: https://laravel.com/docs
- Git Issues du projet
- Fichiers de configuration dans `/config`
