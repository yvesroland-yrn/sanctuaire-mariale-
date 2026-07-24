<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Conseil;
use App\Models\Statistique;
use App\Models\User;
use App\Models\Message;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalActualites = Actualite::count();
        $totalProjets = Projet::count();
        $totalConseils = Conseil::count();
        $totalMessages = Message::count();
        $totalUtilisateurs = User::count();
        $totalAdmins = User::admin()->count();
        $totalActifs = User::actif()->count();
        $totalInactifs = User::inactif()->count();
        $totalStatistiques = Statistique::count();
        $visites = Statistique::byType('dashboard')->byCle('visites')->sum('valeur');
        $dernieresStatistiques = Statistique::orderByDesc('date')->take(5)->get();
        $derniersMessages = Message::orderByDesc('created_at')->take(5)->get();
        $derniersUtilisateurs = User::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', [
            'totalActualites' => $totalActualites,
            'totalProjets' => $totalProjets,
            'totalConseils' => $totalConseils,
            'totalMessages' => $totalMessages,
            'totalUtilisateurs' => $totalUtilisateurs,
            'totalAdmins' => $totalAdmins,
            'totalActifs' => $totalActifs,
            'totalInactifs' => $totalInactifs,
            'totalStatistiques' => $totalStatistiques,
            'visites' => $visites,
            'dernieresStatistiques' => $dernieresStatistiques,
            'derniersMessages' => $derniersMessages,
            'derniersUtilisateurs' => $derniersUtilisateurs,
        ]);
    }

    // ==================== ACTUALITES ====================

    public function actualites()
    {
        $actualites = Actualite::orderBy('date_publication', 'desc')->paginate(15);
        return view('admin.actualites', ['actualites' => $actualites]);
    }

    public function creerActualite()
    {
        return view('admin.actualites.create');
    }

    public function storeActualite(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'required|string|max:300',
            'contenu' => 'required|string',
            'categorie' => 'required|in:projets,education,communaute,culture,sante,actualite',
            'statut' => 'nullable|in:publie,brouillon,archive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'auteur' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $validated['statut'] = $validated['statut'] ?? 'publie';

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['slug'] = str()->slug($validated['titre']);
        $validated['tags'] = $validated['tags'] ? explode(',', $validated['tags']) : [];

        Actualite::create($validated);

        return redirect()->route('admin.actualites')->with('success', 'Actualité créée avec succès.');
    }

    public function editActualite($id)
    {
        $actualite = Actualite::findOrFail($id);
        return view('admin.actualites.edit', ['actualite' => $actualite]);
    }

    public function updateActualite(Request $request, $id)
    {
        $actualite = Actualite::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'resume' => 'required|string|max:300',
            'contenu' => 'required|string',
            'categorie' => 'required|in:projets,education,communaute,culture,sante,actualite',
            'statut' => 'nullable|in:publie,brouillon,archive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'auteur' => 'required|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $validated['statut'] = $validated['statut'] ?? $actualite->statut ?? 'publie';

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        $validated['slug'] = str()->slug($validated['titre']);
        $validated['tags'] = $validated['tags'] ? explode(',', $validated['tags']) : [];

        $actualite->update($validated);

        return redirect()->route('admin.actualites')->with('success', 'Actualité mise à jour avec succès.');
    }

    public function deleteActualite($id)
    {
        $actualite = Actualite::findOrFail($id);
        $actualite->delete();

        return redirect()->route('admin.actualites')->with('success', 'Actualité supprimée avec succès.');
    }

    

    public function statistiques()
    {
        $statistiques = Statistique::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.statistiques', ['statistiques' => $statistiques]);
    }

    public function creerStatistique()
    {
        return view('admin.statistiques.create');
    }

    public function storeStatistique(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'cle' => 'nullable|string|max:255',
            'valeur' => 'required|integer',
            'date' => 'required|date',
        ]);

        Statistique::create($validated);

        return redirect()->route('admin.statistiques')->with('success', 'Statistique créée avec succès.');
    }

    public function editStatistique($id)
    {
        $statistique = Statistique::findOrFail($id);
        return view('admin.statistiques.edit', ['statistique' => $statistique]);
    }

    public function updateStatistique(Request $request, $id)
    {
        $statistique = Statistique::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'cle' => 'nullable|string|max:255',
            'valeur' => 'required|integer',
            'date' => 'required|date',
        ]);

        $statistique->update($validated);

        return redirect()->route('admin.statistiques')->with('success', 'Statistique mise à jour avec succès.');
    }

    public function deleteStatistique($id)
    {
        $statistique = Statistique::findOrFail($id);
        $statistique->delete();

        return redirect()->route('admin.statistiques')->with('success', 'Statistique supprimée avec succès.');
    }

    // ==================== UTILISATEURS / COMPTE ====================

    public function compte()
    {
        return $this->utilisateurs();
    }

    public function utilisateurs()
    {
        $utilisateurs = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.utilisateurs', ['utilisateurs' => $utilisateurs]);
    }

    public function creerUtilisateur()
    {
        return view('admin.utilisateurs.create');
    }

    public function storeUtilisateur(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,moderateur,membre',
            'statut' => 'required|in:actif,inactif',
            'adresse' => 'nullable|string',
        ]);

        User::create($validated);

        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur créé avec succès.');
    }

    public function editUtilisateur($id)
    {
        $utilisateur = User::findOrFail($id);
        return view('admin.utilisateurs.edit', ['utilisateur' => $utilisateur]);
    }

    public function updateUtilisateur(Request $request, $id)
    {
        $utilisateur = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,moderateur,membre',
            'statut' => 'required|in:actif,inactif',
            'adresse' => 'nullable|string',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $utilisateur->update($validated);

        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function deleteUtilisateur($id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur supprimé avec succès.');
    }

   
    // ==================== MESSAGES ====================

    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages', ['messages' => $messages]);
    }

    public function viewMessage($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.show', ['message' => $message]);
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Message supprimé avec succès.');
    }
}