<?php

namespace Tests\Feature;

use App\Models\Actualite;
use App\Models\Conseil;
use App\Models\Message;
use App\Models\Projet;
use App\Models\Statistique;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_real_counts_from_database(): void
    {
        User::create([
            'nom' => 'Admin',
            'prenom' => 'Test',
            'email' => 'admin@example.com',
            'telephone' => '0102030405',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'statut' => 'actif',
        ]);
        User::create([
            'nom' => 'Membre',
            'prenom' => 'Test',
            'email' => 'membre@example.com',
            'telephone' => '0607080910',
            'password' => bcrypt('password'),
            'role' => 'membre',
            'statut' => 'inactif',
        ]);
        Actualite::create([
            'titre' => 'Test actualité',
            'slug' => 'test-actualite',
            'resume' => 'Résumé',
            'contenu' => 'Contenu',
            'statut' => 'publie',
            'categorie' => 'actualite',
            'auteur' => 'Admin',
        ]);
        Projet::create([
            'titre' => 'Test projet',
            'slug' => 'test-projet',
            'description' => 'Description',
            'statut' => 'en-cours',
            'budget' => '100000',
            'avancement' => 20,
            'date_debut' => now()->subMonth(),
            'date_fin' => now()->addMonth(),
        ]);
        Conseil::create([
            'titre' => 'Test conseil',
            'slug' => 'test-conseil',
            'resume' => 'Résumé',
            'contenu' => 'Contenu',
            'statut' => 'publie',
            'categorie' => 'conseils',
            'auteur' => 'Admin',
        ]);
        Message::create([
            'nom' => 'Test',
            'prenom' => 'User',
            'telephone' => '775555555',
            'email' => 'test@example.com',
            'objet' => 'information',
            'message' => 'Message',
            'statut' => 'nouveau',
        ]);
        Statistique::create([
            'type' => 'dashboard',
            'cle' => 'visites',
            'valeur' => 42,
            'date' => now()->toDateString(),
        ]);

        $this->actingAs(User::find(1));

        $response = $this->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('2');
        $response->assertSee('1');
        $response->assertSee('1');
        $response->assertSee('1');
    }
}
