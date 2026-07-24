# 🙏 Sanctuaire Notre Dame de Sassako - Application Web

## 📋 Aperçu du Projet

Application web complète pour le **Sanctuaire Notre Dame de Sassako** - Un lieu de prière et de spiritualité dédié à la Mère de Dieu.

L'application propose :
- **Site Public** : Accueil, À Propos, Projets, Actualités, Conseils Spirituels, Contact
- **Panel Admin** : Gestion des Actualités, Projets, Conseils, Statistiques et Comptes Utilisateurs

## 🔄 Refactoring Effectué

### ✅ Configuration Complète pour le Sanctuaire

**Fichier**: `config/mudea.php`
- ✨ Marque : "Sanctuaire Notre Dame de Sassako"
- 🏷️ Tagline : "Lieu de Prière et de Grâce"
- 📍 Localisation : Sassako, Mali
- 📊 Statistiques adaptées au Sanctuaire
- 🗺️ Navigation simplifiée (5 sections principales)

### ✅ Nouveau Modèle : Conseils Spirituels

**Migration** : `2024_01_15_000010_create_conseils_table.php`
**Modèle** : `app/Models/Conseil.php`

Permet de gérer :
- Prières, Méditations, Enseignements, Témoignages
- Statuts : Publié, Brouillon, Archivé
- Vues et épinglage
- Catégorisation par thème spirituel

### ✅ Routes Refactorisées

**Site Public** : `/`
- `GET /` → Accueil
- `GET /propos` → À Propos
- `GET /projets` → Projets
- `GET /actualites` → Actualités
- `GET /conseils` → Conseils Spirituels ⭐ NEW
- `GET /contact` → Contact

**Authentification** :
- `GET /connexion` → Page de connexion
- `POST /connexion` → Traitement connexion
- `POST /deconnexion` → Déconnexion

**Panel Admin** : `/admin/*`
Gestion CRUD complète pour :
- 📰 Actualités
- 🎯 Projets
- ✨ Conseils Spirituels ⭐ NEW
- 📈 Statistiques
- 👥 Utilisateurs/Compte

### ✅ Contrôleur Admin Refactorisé

**Fichier**: `app/Http/Controllers/AdminController.php`

Fonctionnalités :
- Dashboard avec statistiques
- CRUD complet pour Actualités
- CRUD complet pour Projets
- CRUD complet pour Conseils ⭐ NEW
- CRUD complet pour Statistiques
- CRUD complet pour Utilisateurs

### ✅ Layout Admin Professionnel

**Fichier**: `resources/views/layouts/admin.blade.php`

Caractéristiques :
- Design moderne et responsive
- Sidebar de navigation
- Top bar avec info utilisateur
- Système d'alertes
- Tables de gestion
- Formulaires structurés
- Support mobile

### ✅ Vues Admin Complètes

Créées pour chaque section :

**Actualités** :
- ✅ `admin/actualites/index.blade.php` - Liste
- ✅ `admin/actualites/create.blade.php` - Création
- ✅ `admin/actualites/edit.blade.php` - Édition

**Projets** :
- ✅ `admin/projets/index.blade.php` - Liste
- ✅ `admin/projets/create.blade.php` - Création
- ✅ `admin/projets/edit.blade.php` - Édition

**Conseils** :
- ✅ `admin/conseils/index.blade.php` - Liste
- ✅ `admin/conseils/create.blade.php` - Création
- ✅ `admin/conseils/edit.blade.php` - Édition

**Statistiques** :
- ✅ `admin/statistiques/index.blade.php` - Liste
- ✅ `admin/statistiques/create.blade.php` - Création
- ✅ `admin/statistiques/edit.blade.php` - Édition

**Utilisateurs** :
- ✅ `admin/utilisateurs/index.blade.php` - Liste
- ✅ `admin/utilisateurs/create.blade.php` - Création
- ✅ `admin/utilisateurs/edit.blade.php` - Édition

### ✅ Interaction Base de Données - Interface Admin

- Upload d'images (Actualités, Conseils)
- Upload de fichiers (Projets)
- Pagination automatique (15 par page)
- Validation des données
- Soft deletes activés
- Timestamps (created_at, updated_at)
- Relations utilisateur (qui a créé/modifié)

### ✅ Documentation

- ✅ `SETUP.md` - Guide complet d'installation et configuration
- ✅ `README.md` - Ce fichier

## 🗂️ Structure des Fichiers

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php (✏️ Refactorisé)
│   │       └── PageController.php (✏️ Mis à jour)
│   └── Models/
│       ├── Actualite.php
│       ├── Conseil.php (✨ NEW)
│       ├── Projet.php
│       ├── Statistique.php
│       └── User.php
├── config/
│   └── mudea.php (✏️ Refactorisé pour Sanctuaire)
├── database/
│   ├── migrations/
│   │   └── 2024_01_15_000010_create_conseils_table.php (✨ NEW)
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── admin.blade.php (✨ NEW - Layout admin complet)
│       │   └── header.blade.php (✏️ Mis à jour)
│       ├── admin/
│       │   ├── dashboard.blade.php (✏️ Refactorisé)
│       │   ├── actualites/ (✨ Vues complètes)
│       │   ├── projets/ (✨ Vues complètes)
│       │   ├── conseils/ (✨ NEW - Vues complètes)
│       │   ├── statistiques/ (✨ Vues complètes)
│       │   └── utilisateurs/ (✨ Vues complètes)
│       └── pages/
│           ├── Accueil.blade.php
│           ├── actualites.blade.php
│           ├── projets.blade.php
│           ├── conseils.blade.php (✨ NEW)
│           └── contact.blade.php
├── routes/
│   └── web.php (✏️ Complètement refactorisé)
├── SETUP.md (✨ NEW - Guide d'installation)
└── README.md (Ce fichier)
```

## 🚀 Démarrage Rapide

### 1. Cloner et Configurer

```bash
# Configuration .env
cp .env.example .env

# Modifier les paramètres de base de données
nano .env
```

### 2. Installer les Dépendances

```bash
composer install
npm install
```

### 3. Préparer la Base de Données

```bash
# Générer la clé
php artisan key:generate

# Créer les tables
php artisan migrate

# Créer un utilisateur admin (optionnel)
php artisan tinker
# Puis exécuter le code du SETUP.md
```

### 4. Lancer le Serveur

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Accédez à : `http://localhost:8000`

## 👤 Comptes par Défaut

| Type | Email | Mot de passe |
|------|-------|-------------|
| Admin | admin@sanctuaire.local | password123 |

## 🎯 Sections du Panel Admin

### 📊 Dashboard
- Vue d'ensemble avec statistiques clés
- Nombre total de chaque ressource

### 📰 Actualités
- Gestion complète des articles
- Catégorisation (Actualité, Projets, etc.)
- Statuts (Publié, Brouillon, Archivé)
- Upload d'images
- Épinglage en première page

### 🎯 Projets
- Suivi d'avancement (0-100%)
- Budget en FCFA
- Secteurs (Éducation, Santé, Eau, etc.)
- Statuts (Futur, En cours, Réalisé)
- Dates de début et fin

### ✨ Conseils Spirituels (NEW)
- Prières, Méditations, Enseignements
- Témoignages de foi
- Catégorisation thématique
- Statuts de publication
- Upload d'images illustratives

### 📈 Statistiques
- Enregistrement de métriques
- Suivi par type et date
- Valeurs numériques

### 👥 Compte (Utilisateurs)
- Gestion des administrateurs
- Rôles et permissions
- Statuts actif/inactif
- Informations de contact

## 🔐 Sécurité

- ✅ Authentification Laravel
- ✅ Protection CSRF
- ✅ Middleware d'authentification
- ✅ Hachage des mots de passe
- ✅ Soft deletes (données non vraiment supprimées)

## 📱 Responsive Design

- ✅ Adapté mobile
- ✅ Sidebar responsive
- ✅ Grilles flexibles
- ✅ Navigation mobile

## 🛠️ Technologies Utilisées

- **Framework** : Laravel 11
- **Base de données** : MySQL
- **Frontend** : Blade + Vite
- **JavaScript** : Vue.js (optionnel)
- **Styling** : CSS3

## 📞 Support

Consultez `SETUP.md` pour :
- Instructions d'installation détaillées
- Troubleshooting
- Configuration avancée
- Structure des modèles

## 📄 Licence

© 2026 Sanctuaire Notre Dame de Sassako

---

**Dernière mise à jour** : 2026-07-10
**Statut** : ✅ Refactoring Complet
**Version** : 2.0 - Sanctuaire Edition
