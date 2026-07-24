# 🗄️ Configuration MySQL - Sanctuaire Notre Dame de Sassako

## 📋 Prérequis

- MySQL 5.7+ ou MariaDB 10.2+
- Accès à la ligne de commande MySQL
- Compte root ou compte avec privilèges de création

## 🔧 Configuration Étape par Étape

### Étape 1: Créer la Base de Données

Ouvrez MySQL en ligne de commande :

```bash
mysql -u root -p
```

Entrez votre mot de passe root, puis exécutez :

```sql
CREATE DATABASE sanctuaire_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Étape 2: Créer un Utilisateur (Optionnel mais Recommandé)

```sql
CREATE USER 'sanctuaire_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';
GRANT ALL PRIVILEGES ON sanctuaire_db.* TO 'sanctuaire_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Étape 3: Configurer le Fichier .env

Ouvrez le fichier `.env` à la racine du projet :

```env
# Option 1 : Utiliser root
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanctuaire_db
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe_root

# Option 2 : Utiliser sanctuaire_user (recommandé)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sanctuaire_db
DB_USERNAME=sanctuaire_user
DB_PASSWORD=mot_de_passe_securise
```

### Étape 4: Vérifier la Connexion

```bash
php artisan tinker
DB::connection()->getPdo();
```

Si pas d'erreur, la connexion est OK.

### Étape 5: Exécuter les Migrations

```bash
php artisan migrate
```

Cela créera les tables suivantes:
- ✅ users
- ✅ cache
- ✅ jobs
- ✅ actualites
- ✅ projets
- ✅ messages
- ✅ evenements
- ✅ pages
- ✅ newsletters
- ✅ parametres
- ✅ statistiques
- ✅ conseils ⭐ NEW

### Étape 6: Vérifier les Tables

```bash
mysql -u root -p
USE sanctuaire_db;
SHOW TABLES;
```

Vous devriez voir toutes les tables listées.

## 👤 Créer l'Utilisateur Admin

### Méthode 1: Via Tinker (Recommandée)

```bash
php artisan tinker
```

Exécutez dans l'invite Tinker:

```php
# Créer l'admin
$admin = App\Models\User::create([
    'nom' => 'Admin',
    'prenom' => 'Sanctuaire',
    'email' => 'admin@sanctuaire.local',
    'password' => Hash::make('password123'),
    'role' => 'admin',
    'statut' => 'actif',
    'telephone' => '+223 XX XX XX XX',
    'adresse' => 'Sassako, Mali'
]);

# Vérifier la création
echo "Admin créé: " . $admin->email;

# Quitter
exit
```

### Méthode 2: Via Query MySQL

```bash
mysql -u root -p
USE sanctuaire_db;

INSERT INTO users (
    nom, prenom, email, password, role, statut, 
    telephone, adresse, created_at, updated_at
) VALUES (
    'Admin',
    'Sanctuaire',
    'admin@sanctuaire.local',
    '$2y$12$... (hash générée par laravel)',
    'admin',
    'actif',
    '+223 XX XX XX XX',
    'Sassako, Mali',
    NOW(),
    NOW()
);
```

**Attention**: Utiliser Tinker est plus sûr car il hash automatiquement le mot de passe.

### Méthode 3: Créer d'autres Utilisateurs

```bash
php artisan tinker

# Modérateur
$mod = App\Models\User::create([
    'nom' => 'Moderateur',
    'prenom' => 'Test',
    'email' => 'moderateur@sanctuaire.local',
    'password' => Hash::make('mod123456'),
    'role' => 'moderateur',
    'statut' => 'actif',
]);

# Membre
$member = App\Models\User::create([
    'nom' => 'Membre',
    'prenom' => 'Test',
    'email' => 'membre@sanctuaire.local',
    'password' => Hash::make('mem123456'),
    'role' => 'membre',
    'statut' => 'actif',
]);

exit
```

## 🔍 Vérifier la Base de Données

### Vérifier les utilisateurs créés

```bash
php artisan tinker
App\Models\User::all();
exit
```

### Vérifier les tables

```bash
mysql -u root -p
USE sanctuaire_db;
DESC users;
```

### Vérifier les statistiques

```bash
mysql -u root -p
USE sanctuaire_db;
SELECT COUNT(*) as total_users FROM users;
SELECT COUNT(*) as total_actualites FROM actualites;
SELECT COUNT(*) as total_projets FROM projets;
SELECT COUNT(*) as total_conseils FROM conseils;
```

## 🛠️ Troubleshooting

### Erreur: "SQLSTATE[HY000]: General error"

```bash
# Réinitialiser la base de données (ATTENTION: efface tout!)
php artisan migrate:fresh

# Puis créer l'admin à nouveau
php artisan tinker
# ... code de création admin ...
```

### Erreur: "Unknown database 'sanctuaire_db'"

Assurez-vous que la base de données existe :

```bash
mysql -u root -p
SHOW DATABASES;
```

Si elle n'existe pas, la créer :

```bash
CREATE DATABASE sanctuaire_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Erreur: "Access denied for user 'sanctuaire_user'@'localhost'"

Vérifier que l'utilisateur existe et les permissions sont correctes :

```bash
mysql -u root -p
SELECT User, Host FROM mysql.user WHERE User='sanctuaire_user';
GRANT ALL PRIVILEGES ON sanctuaire_db.* TO 'sanctuaire_user'@'localhost';
FLUSH PRIVILEGES;
```

### Erreur: "Laravel database connection error"

1. Vérifier les paramètres `.env`:
   ```bash
   cat .env | grep DB_
   ```

2. Tester la connexion:
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

3. Vérifier MySQL tourne:
   ```bash
   sudo systemctl status mysql  # Linux
   # ou
   net start MySQL80  # Windows
   ```

## 📊 Sauvegarde et Restauration

### Sauvegarder la Base de Données

```bash
mysqldump -u root -p sanctuaire_db > backup_sanctuaire.sql
```

### Restaurer la Base de Données

```bash
mysql -u root -p sanctuaire_db < backup_sanctuaire.sql
```

## 🔐 Sécurité

1. **Changer le mot de passe admin**
   - Accéder à `/admin/dashboard`
   - Modifier le profil
   - Changer le mot de passe

2. **Changer le mot de passe MySQL**
   ```bash
   mysql -u root -p
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'nouveau_mot_de_passe';
   FLUSH PRIVILEGES;
   ```

3. **Créer des sauvegardes régulières**
   ```bash
   # Automatiser avec cron
   0 2 * * * mysqldump -u root -p'password' sanctuaire_db > /backup/sanctuaire_$(date +\%Y\%m\%d).sql
   ```

## ✅ Checklist de Vérification

- [ ] Base de données créée
- [ ] Utilisateur MySQL créé (optionnel)
- [ ] Fichier `.env` configuré
- [ ] `php artisan migrate` exécuté avec succès
- [ ] Utilisateur admin créé
- [ ] Accès au panel admin fonctionnel
- [ ] Upload de fichiers fonctionnel
- [ ] Pagination des données fonctionnelle

## 📞 Support

Si vous rencontrez des problèmes:

1. Vérifier les logs:
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. Vérifier les tables:
   ```bash
   php artisan tinker
   App\Models\User::count();
   ```

3. Réinitialiser (ATTENTION: EFFACE TOUT):
   ```bash
   php artisan migrate:refresh
   ```

---

**Dernière mise à jour**: 2026-07-10
