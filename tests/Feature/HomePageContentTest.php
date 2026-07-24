<?php

namespace Tests\Feature;

use App\Models\Actualite;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_admin_projects_and_news(): void
    {
        Projet::create([
            'titre' => 'Projet dynamique',
            'slug' => 'projet-dynamique',
            'description' => 'Description du projet',
            'statut' => 'en-cours',
            'secteur' => 'education',
            'budget' => '500000',
            'avancement' => 65,
            'date_debut' => now()->subMonth(),
            'date_fin' => now()->addMonth(),
            'featured' => false,
        ]);

        Actualite::create([
            'titre' => 'Actualité dynamique',
            'slug' => 'actualite-dynamique',
            'categorie' => 'actualite',
            'statut' => 'publie',
            'auteur' => 'Admin',
            'date_publication' => now()->toDateString(),
            'resume' => 'Résumé de l’actualité',
            'contenu' => 'Contenu complet',
        ]);

        $response = $this->get(route('Accueil'));

        $response->assertOk();
        $response->assertSee('Projet dynamique');
        $response->assertSee('Actualité dynamique');
    }

    public function test_admin_create_forms_preselect_published_status(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'statut' => 'actif',
        ]);

        $this->actingAs($user);

        $this->get(route('admin.actualites.creer'))->assertOk()->assertSee('value="publie" selected', false);
        $this->get(route('admin.conseils.creer'))->assertOk()->assertSee('value="publie" selected', false);
    }

    public function test_admin_crud_forms_submit_to_store_routes(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'statut' => 'actif',
        ]);

        $this->actingAs($user);

        $this->get(route('admin.actualites'))->assertOk()->assertSee('action="' . route('admin.actualites.store') . '"', false);
        $this->get(route('admin.projets'))->assertOk()->assertSee('action="' . route('admin.projets.store') . '"', false);
    }
}
